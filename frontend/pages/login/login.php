<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>APLite Login</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/login.css">
</head>
<body>
    <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
        <div class="overlay active" id="logoutOverlay"></div>
        <div class="modal active" id="logoutModal">
            <img src="../../image/verify.svg" alt="Success" class="modal-img">
            <div class="text-group">
                <span class="medium-green-title">Signed Out</span>
                <span class="green-description">You have been successfully logged out.</span>
            </div>
            <button type="button" class="green-button" onclick="closeLogoutModal()">OK</button>
        </div>

        <script>
            function closeLogoutModal() {
                document.getElementById('logoutOverlay').classList.remove('active');
                document.getElementById('logoutModal').classList.remove('active');
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        </script>
    <?php endif; ?>

    <div class="wrapper">
        <div class="login-bg fade-bg">
            <div class="bg-text">
                <h2>Building a sustainable future</h2>
                <p>saving energy with a few clicks</p>
            </div>
        </div>

        <div class="container fade-form">
            <div class="title-intro">
                <span class="big-heading">Hello, Welcome Back</span>
                <span class="small-heading">We are happy to have you back in APLite</span>
            </div>
            <form method="POST" action="../../../backend/auth/login_process.php">
                <div class="input-area">
                    <div class="input-box">
                        <input type="text" name="identifier" placeholder="enter username or email" required>
                    </div>

                    <div class="input-box">
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password-field" placeholder="enter password" required>
                            <button type="button" id="togglePassword" class="password-toggle-btn">
                                <img src="../../image/eye.svg" id="eyeIcon" alt="Toggle Password">
                            </button>
                        </div>
                    </div>

                    <div class="remember">
                        <label class="checkbox-container">
                            <input class="custom-checkbox" type="checkbox" name="remember">
                            <span class="checkmark"></span>
                        </label>
                        <span>Remember Me</span>
                    </div>
                </div>
                    <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            $msg = "";
                            
                            if ($error == "notfound") $msg = "No account found with that username.";
                            if ($error == "wrongpass") $msg = "Incorrect password. Please try again.";

                            if ($msg) {
                                echo "<div class='feedback-container'><div class='error-banner'>$msg</div></div>";
                            }
                        }
                    ?>
                <div class="button-area">
                    <button type="submit"><span class="gradient-text">Sign In</span></button>
                </div>
            </form>
        </div>
    </div>

    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password-field');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordField.getAttribute('type') === 'password';
        
        passwordField.setAttribute('type', isPassword ? 'text' : 'password');
        
        eyeIcon.src = isPassword 
            ? "../../image/eye-slash.svg" 
            : "../../image/eye.svg";
    });
    </script>
</body>
</html>