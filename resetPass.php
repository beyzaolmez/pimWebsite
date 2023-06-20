<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="css/signIn.css">
</head>

<body>
<div id="container">
    <div id="resetPass">
        <h1>Reset your password</h1>
        <h3>Reset successful! <a>Go back to login</a></h3>
        <form action="recoverPass.php" method="POST">
            <div class="credentials">
                <input class="info" name="email" placeholder="New Password">
                <input class="info" name="passwordCheck" placeholder="Repeat new password">
            </div>
            <div class="submit">
                <input class="button" type="submit" value="sign in">
            </div>
        </form>
    </div>
</div>
</body>
</html>
