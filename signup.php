<?php
    try{
        $dbhandler = new PDO("mysql:host=mysql; dbname=aipim; charset=utf8", "root", "qwerty");
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $ex){
        echo "Connection failed" .$ex->getMessage();
        exit();
    }

    $err = [];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user_name = filter_input(INPUT_POST, "user_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password");

        if(strlen($user_name) < 3){
            $err[] = "Please enter a valid name";
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $err[] = "Please enter a valid email";
        }

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[A-Z]@', $password);
        $numbers = preg_match('@[0-9]@', $password);

        if(!$uppercase || !$lowercase || !$numbers || strlen($password) < 8){
            $err[] = "Your password must contain at least 1 capital letter and 1 number";
        }
        else{
            $password = password_hash($password, PASSWORD_BCRYPT);
        }

        $sql = "SELECT user_id from Users WHERE email_address = :email_address;";
        $sql = $dbhandler->prepare($sql);
        $sql->bindParam(":email_address", $email, PDO::PARAM_STR);
        $sql->execute();

        if($result = $sql->fetchColumn()){
            $err[] = "Email already exists";
        }

        if(count($err) > 0) {
            echo "<ul>";
            foreach ($err as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
        else{
            $sql = "INSERT INTO Users(`user_id`, `user_name`, `email_address`, `user_password`, `password_change_date`)
			VALUES(NULL, :user_name, :email_address, :user_password, NULL);";
            $sql = $dbhandler->prepare($sql);
            $sql->bindParam(":user_name", $user_name, PDO::PARAM_STR);
            $sql->bindParam(":email_address", $email, PDO::PARAM_STR);
            $sql->bindParam(":user_password", $password, PDO::PARAM_STR);
            $sql->execute();
            $sql-> bindParam(":user_id", $id, PDO::PARAM_STR);
            $sql-> bindParam(":password_change_date", $passwordChangeDate, PDO::PARAM_INT);
            header("Location:#");
        }

    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/signIn.css">
</head>

<body>
<div id="container">
    <div id="signup">
        <h1>Sign-in</h1>
        <form action="signup.php" method="POST">
            <div class="credentials">
                <input class="info" name="user_name" placeholder="Full Name">
                <input class="info" name="email" placeholder="Email">
                <input class="info" name="password" placeholder="Password">
            </div>
            <div class="submit">
                <input class="button" type="submit" value="sign up">
            </div>
        </form>
        <p> Already have an account? <a href="signIn.php">Login</a> </p>
    </div>
</div>
</body>
</html>

