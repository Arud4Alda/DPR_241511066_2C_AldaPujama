<!DOCTYPE html>
<html>
<head>
    <title>Data Gaji DPR</title>
</head>
<body
    data-flash-success="<?= session()->getFlashdata('success') ?>" 
    data-flash-error="<?= session()->getFlashdata('error') ?>">
    
    <h2>Komponen Gaji DPR</h2>
    <div style="text-align:right; margin-bottom:20px;  margin-right:140px;">
        <a href="<?= site_url('admin/gaji/tambah') ?>" class="btn btn-add" id="tambahGajiBtn">+ Tambah Komponen Gaji</a>
    </div>
    <table id="gajiTable">
        <thead>
        <tr>
            <th>Id Komponen</th>
            <th>Nama Komponen</th>
            <th>Kategori</th>
            <th>Jabatan</th>
            <th>Nominal</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script>
        const gajiData = <?= $komponen_gaji ?>;
    </script>
</body>
</html>
