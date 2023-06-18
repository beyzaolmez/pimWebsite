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
                <textarea name="fullName" placeholder="Full Name"></textarea>
                <textarea name="email" placeholder="Email"></textarea>
                <textarea name="password" placeholder="Password"></textarea>
            </div>
            <div class="submit">
                <input type="submit" value="sign up">
            </div>
        </form>
        <p> Already have an account? <a href="signIn.php">Login</a> </p>
    </div>
</div>
</body>
</html>

