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
            <form action="signIn.php" method="POST">
                <div class="credentials">
                    <textarea name="email" placeholder="Email"></textarea>
                    <textarea name="password" placeholder="Password"></textarea>
                    <label> Forgot your password?</label>
                </div>
                <div class="submit">
                    <input type="submit" value="sign in">
                </div>
            </form>
            <p> Don't have an account? <a href="signup.php">Signup Here</a> </p>
        </div>
    </div>
    </body>
</html>
