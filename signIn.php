<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $passwordCheck = filter_input(INPUT_POST, "passwordCheck");

        try{
            $dbhandler = new PDO("mysql:host=mysql; dbname=aipim; charset=utf8", "root", "qwerty");
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $ex){
            echo "Connection failed: ".$ex->getMessage();
        }

        $stmt = "SELECT * FROM Users WHERE email_address = :email_address;";
        $sql = $dbhandler->prepare($stmt);
        $sql->bindParam(":email_address", $email, PDO::PARAM_STR);
        $sql->execute();
        $dbhandler = null;

        if($sql->rowCount() == 0){
            echo "Email or password does not match";
        }
        else {
            if ($details = $sql->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($_POST["passwordCheck"], $details["user_password"])) {
                    header("Location:translate_Text.php");
                }
            } else {
                echo "Wrong email or password";
            }
        }

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign in</title>
        <link rel="stylesheet" href="css/signIn.css">
    </head>

    <body>
    <div id="container">
        <div id="singIn">
            <h1>Sign-in</h1>
            <?php
                if (isset($_GET["newpwd"])) {
                    if ($_GET["newpwd"] == "passwordupdated") {
                        echo '<p>Reset successful!</p>';
                    }
                }
            ?>
            <form action="signIn.php" method="POST">
                <div class="credentials">
                    <input class="info" name="email" placeholder="Email">
                    <input class="info" name="passwordCheck" placeholder="Password">
                    <label> Forgot your password?</label>
                </div>
                <div class="submit">
                    <input class="button" type="submit" value="sign in">
                </div>
            </form>
            <p> Don't have an account? <a href="signup.php">Signup Here</a> </p>
        </div>
    </div>
    </body>
</html>
