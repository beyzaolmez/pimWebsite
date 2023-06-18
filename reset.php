<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Translate text</title>
    <link rel="stylesheet" href="css/recover.css">
</head>

<body>
    <div id="container">
    <main>
        <h1>Reset your password</h1>
        <?php
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];

            //check if tokens exist inside the url
            if (empty($selector) || empty($validator)) {
                echo "<p> We couldn't validate your request! </p>";
            } else {
        ?>
        
        <p>
        <?php
            if (isset($_GET["reset"])) {
                if ($_GET["reset"] == "success") {
                    echo 'Reset successful! <a href="signIn.php">Go back to login</a>';
                }
            }
        ?>
        </p>
        <form action="#" method="POST">
            <input type="hidden" name="selector" value="<?php echo $selector ?>">
            <input type="hidden" name="validator" value="<?php echo $validator ?>">
            
            <div class="credentials">
                <input class="info" type="password" name="pwd" id="pass1" placeholder="New password">
                <input class="info" type="password" name="pwd-repeat" id="pass2" placeholder="Repeat new password">
            </div>

            <div class="submit">
                <input class="button" type="submit" name="reset-request-submit" value="Reset">
            </div>
        </form>
        <p> Remembered your password? <a href="signIn.php">Login</a> </p>

        <?php
            if (isset($_GET["newpwd"])) {
                if ($_GET["newpwd"] == "pwdempty") {
                    echo '<p> Your password cannot be empty! </p> ';
                }
            }
            
            if (isset($_GET["newpwd"])) {
                if ($_GET["newpwd"] == "pwdnotsame") {
                    echo '<p> Your passwords are not the same! </p> ';
                }
            }
        ?>

        <?php
            }
        ?>
    </main>  
    </div>
</body>
</html>