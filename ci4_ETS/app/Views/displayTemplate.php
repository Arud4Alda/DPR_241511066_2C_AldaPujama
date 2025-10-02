<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>
</head>
<body>

    <div class="header">
        <h1>Website </h1>
    </div>

    <?php
        $role = session()->get('role');
    ?>
    <div class="menu">
        <?php if ($role === 'admin'): ?>
            <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('logout') ?>">Logout</a>
        <?php elseif ($role === 'students'): ?>
            <a href="<?= base_url('mahasiswa/dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('logout') ?>">Logout</a>
        <?php endif; ?>
    </div>

    <div class="content">
        <?= $content ?>
    </div>

    <div class="footer">
        <p>&copy; <?= date('Y') ?> Politeknik Negeri Bandung <br> Teknik Komputer Dan Informatika<br>2025</p>
    </div>
    <!--<script src="<?//= base_url('js/app.js') ?>"></script>-->
</body>
</html>