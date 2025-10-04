<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota DPR</title>
</head>
<body
    data-flash-success="<?= session()->getFlashdata('success') ?>" >
    
    <h2>Daftar Anggota DPR</h2>
    <div style="text-align:right; margin-bottom:20px;  margin-right:140px;;">
        <a href="<?= site_url('admin/dpr/tambah') ?>" class="btn btn-add" id="tambahDPRBtn">+ Tambah DPR</a>
    </div>
    <div style="margin-bottom: 20px; display: flex; justify-content: center; align-items: center;">
        <?php 
            $searchValue = service('request')->getGet('search') ?? '';
        ?>
        <input type="text" id="searchInputDPR" placeholder="Cari Anggota (Nama, Jabatan, ID)..." 
            style="padding: 8px; width: 300px; margin-right: 10px;" 
            value="<?= esc($searchValue) ?>">
        <button id="searchButtonDPR" class="btn btn-edit" style="padding: 8px 15px;">Cari</button>
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
