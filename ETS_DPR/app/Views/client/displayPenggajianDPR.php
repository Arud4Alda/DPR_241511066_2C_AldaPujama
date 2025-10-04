<!DOCTYPE html>
<html>
<head>
    <title>Data Penggajian DPR</title>
</head>
<body>
    <h2>Daftar Penggajian DPR</h2>
    <table id="dprpenggajianTable">
        <thead>
        <tr>
            <th>Id Anggota</th>
            <th>Gelar Depan</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>            
            <th>Gelar Belakang</th>
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
