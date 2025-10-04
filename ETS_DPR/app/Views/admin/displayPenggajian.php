<!DOCTYPE html>
<html>
<head>
    <title>Data Penggajian DPR</title>
</head>
<body
    data-flash-success="<?= session()->getFlashdata('success') ?>">
    
    <h2>Daftar Penggajian DPR</h2>
    <div style="text-align:right; margin-bottom:20px;  margin-right:90px;;">
        <a href="<?= site_url('admin/penggajian/tambah') ?>" class="btn btn-add" id="tambahPenggajianBtn">+ Tambah Penggajian DPR</a>
    </div>

    <div style="margin-bottom: 20px; display: flex; justify-content: center; align-items: center;">
        <?php 
            $searchValue = service('request')->getGet('search') ?? '';
        ?>
        <input type="text" id="searchInputPenggajian" placeholder="Cari Daftar Gaji (Nama, Jabatan, ID, take Home Pay)..." 
            style="padding: 8px; width: 300px; margin-right: 10px;" 
            value="<?= esc($searchValue) ?>">
        <button id="searchButtonPenggajian" class="btn btn-edit" style="padding: 8px 15px;">Cari</button>
    </div>

    <table id="penggajianTable">
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
