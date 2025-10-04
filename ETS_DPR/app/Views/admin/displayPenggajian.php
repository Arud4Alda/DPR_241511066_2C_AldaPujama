<!DOCTYPE html>
<html>
<head>
    <title>Data Penggajian DPR</title>
</head>
<body>
    <h2>Daftar Penggajian DPR</h2>
    <div style="text-align:right; margin-bottom:20px;  margin-right:230px;;">
        <a href="<?= site_url('admin/penggajian/tambah') ?>" class="btn btn-add" id="tambahPenggajianBtn">+ Tambah Penggajian DPR</a>
    </div>
    <table id="penggajianTable">
        <thead>
        <tr>
            <th>Id Anggota</th>
            <th>Nama Lengkap</th>
            <th>Jabatan</th>
            <th>Take Home Pay</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script>
        const penggajianData = <?= $penggajian ?>;
    </script>
</body>
</html>
