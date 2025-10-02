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
        <h1>Aplikasi Perhitungan Transfaransi Gaji DPR</h1>
    </div>

    <?php
        $role = session()->get('role');
    ?>
    <div class="menu">
        <?php if ($role === 'Admin'): ?>
            <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('admin/dpr') ?>">Data Anggota DPR</a>
            <a href="<?= base_url('admin/gaji') ?>">Komponen Gaji</a>
            <a href="<?= base_url('admin/penggajian') ?>">Penggajian</a>
            <a href="<?= base_url('logout') ?>">Logout</a>
        <?php elseif ($role === 'Public'): ?>
            <a href="<?= base_url('client/dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('client/dpr') ?>">Data Anggota DPR</a>
            <a href="<?= base_url('client/gaji') ?>">Data Gaji Anggota DPR</a>
            <a href="<?= base_url('logout') ?>">Logout</a>
        <?php endif; ?>
    </div>

    <div class="content">
        <?= $content ?>
    </div>

    <div class="footer">
        <p>&copy; <?= date('Y') ?> Politeknik Negeri Bandung <br> Teknik Komputer Dan Informatika<br>2025</p>
    </div>
    <script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>