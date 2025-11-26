<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> -->
    <title>APLite Login</title>
    <link rel="stylesheet" href="../../styles/login.css">
    <link rel="stylesheet" href="../../styles/global.css">
</head>
<body>
    <div class="wrapper">
        <div class="title-intro">
            <span class="big-heading">Hello, Welcome Back</span>
            <span class="small-heading">We are happy to have you back in APLite</span>
        </div>
        <form action="#">
            <div class="input-box">
                <input type="text" required>
                <label for="">Username</label>
            </div>

            <div class="input-box">
                <input type="password" required>
                <label for="">Password</label>
            </div>

            <div class="remember">
                <input type="checkbox">
                <label>Remember Me</label>
            </div>

            <button type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>