<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body style="background-color: #dadadac8;">
    <div class="login-box">
        <h2 style="text-align: center;">Login</h2>

        <?php if(session()->getFlashdata('error')): ?>
             <div style="background-color: red; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align:center;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form id="loginForm" action="<?= base_url('/login/auth') ?>" method="POST" novalidate>
        <div id="formStatusMessage"></div>    
            <label for="username">Username :</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password :</label>
            <input type="password" name="password" id="password" required>

            <br><br>
            <input type="submit" value="Login" class="btn btn-edit">
        </form>
    </div>
    <script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>
