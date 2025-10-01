<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota DPR</title>
</head>
<body>
    <h2>Daftar Anggota DPR</h2>
    <table id="anggotaDPRTable">
        <thead>
        <tr>
            <th>id_anggota</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Gelar Depan</th>
            <th>Gelar Belakang</th>
            <th>Jabatan</th>
            <th>Status Nikah</th>
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
