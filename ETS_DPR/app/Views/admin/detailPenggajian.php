<!DOCTYPE html>
<html>
<head>
    <title>Detail Penggajian DPR</title>
</head>
<body>
    <p style="text-align: center;">Detail Penggajian DPR</p>
    <div class="card">
    <ul>
        <li>Nama Lengkap : <?= $penggajian['nama_lengkap'] ?></li>
        <li>List Komponen Gaji : <?= $penggajian['list_komponen'] ?></li>
        <li>Take Home Pay : Rp <?= number_format($penggajian['take_home_pay'], 0, ',', '.') ?></li><br><br><br>
    </ul>
    <div style="text-align:right; margin-bottom:20px;  margin-right:200px;;">
        <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-edit" id="kembaliBtn">Kembali</a>
    </div>
    </div>
</body>
</html>
