<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota DPR</title>
</head>
<body>
    <h2>Daftar Anggota DPR</h2>
    <div style="text-align:right; margin-bottom:20px;  margin-right:140px;;">
        <a href="<?= site_url('admin/dpr/tambah') ?>" class="btn btn-add" id="tambahDPRBtn">+ Tambah DPR</a>
    </div>
    <table id="DPRTable">
        <thead>
        <tr>
            <th>Id Anggota</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Gelar Depan</th>
            <th>Gelar Belakang</th>
            <th>Jabatan</th>
            <th>Status Nikah</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script>
        const anggotaData = <?= $anggota ?>;
    </script>
</body>
</html>
