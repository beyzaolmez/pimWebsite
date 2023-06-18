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
        <h1>Forgot your password?</h1>
        <p>
        <?php
            if (isset($_GET["reset"])) {
                if ($_GET["reset"] == "success") {
                    echo 'The mail has been sent! Check your inbox.';
                }
            }
        ?>
        </p>
        <form action="#" method="POST">
            <div class="credentials">
                <input class="info" name="email" placeholder="Email">
            </div>
            <div class="submit">
                <input class="button" type="submit" name="reset-request-submit" value="Send mail">
            </div>
        </form>
        <p> Remembered your password? <a href="signIn.php">Login</a> </p>
    </main>  
    </div>
</body>
</html>