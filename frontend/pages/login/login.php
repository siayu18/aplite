<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>APLite Login</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="login-bg">
            <div class="bg-text">
                <h2>Building a sustainable future</h2>
                <p>saving energy with a few clicks</p>
            </div>
        </div>

        <div class="container">
            <div class="title-intro">
                <span class="big-heading">Hello, Welcome Back</span>
                <span class="small-heading">We are happy to have you back in APLite</span>
            </div>
            <form action="#">
                <div class="input-area">
                    <div class="input-box">
                        <input type="text" placeholder="enter username" required>
                    </div>

                    <div class="input-box">
                        <input type="password" placeholder="enter password" required>
                    </div>

                    <div class="remember">
                        <label class="checkbox-container">
                            <input class="custom-checkbox" type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <span>Remember Me</span>
                    </div>
                </div>
                <div><button type="submit"><span class="gradient-text">Sign In</span></button></div>
            </form>
        </div>
    </div>
</body>
</html>