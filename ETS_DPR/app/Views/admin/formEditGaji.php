<!DOCTYPE html>
<html>
<head>
    <title>Edit Komponen Gaji DPR</title>
</head>
<body>
    <div class="form-box">
    <h3 style="text-align: center;">Form Edit Komponen Gaji DPR</h3>
    <form id="gajiEditForm" method="post" action="<?= site_url('admin/gaji/update/'.$gaji['id_komponen_gaji']) ?>" novalidate>   
        <div id="formStatusMessage"></div>
        <label for="id_komponen_gaji">Id Komponen Gaji:</label><br>
        <input type="number" name="id_komponen_gaji" id="id_komponen_gaji" value="<?= $gaji['id_komponen_gaji'] ?>" required><br><br>

        <label for="nama_komponen">Nama Komponen:</label><br>
        <input type="text" name="nama_komponen" id="nama_komponen" value="<?= $gaji['nama_komponen'] ?>" required><br><br>

        <label for="kategori">Kategori:</label><br>
        <select id="kategori" name="kategori" value="<?= $gaji['kategori'] ?>">
            <option value="Gaji Pokok" <?= ($gaji['kategori'] == 'Gaji Pokok') ? 'selected' : '' ?>>Gaji Pokok</option>
            <option value="Tunjangan Melekat" <?= ($gaji['kategori'] == 'Tunjangan Melekat') ? 'selected' : '' ?>>Tunjangan Melekat</option>
            <option value="Tunjangan Lain" <?= ($gaji['kategori'] == 'Tunjangan Lain') ? 'selected' : '' ?>>Tunjangan Lain</option>
        </select><br><br>

        <label for="jabatan">Jabatan:</label><br>
        <select id="jabatan" name="jabatan" value="<?= $gaji['jabatan'] ?>">
            <option value="Ketua" <?= ($gaji['jabatan'] == 'Ketua') ? 'selected' : '' ?>>Ketua</option>
            <option value="Wakil Ketua" <?= ($gaji['jabatan'] == 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
            <option value="Anggota" <?= ($gaji['jabatan'] == 'Anggota') ? 'selected' : '' ?>>Anggota</option>
            <option value="Semua" <?= ($gaji['jabatan'] == 'Semua') ? 'selected' : '' ?>>Semua</option>
        </select><br><br>

        <label for="nominal">Nominal:</label><br>
        <input type="number" name="nominal" id="nominal" value="<?= $gaji['nominal'] ?>" required><br><br>

        <label for="satuan">Satuan:</label><br>
        <select id="satuan" name="satuan" value="<?= $gaji['satuan'] ?>" required>
            <option value="Hari" <?= ($gaji['satuan'] == 'Hari') ? 'selected' : '' ?>>Hari</option>
            <option value="Bulan" <?= ($gaji['satuan'] == 'Bulan') ? 'selected' : '' ?>>Bulan</option>
            <option value="Periode" <?= ($gaji['satuan'] == 'Periode') ? 'selected' : '' ?>>Periode</option>
        </select><br><br>

        <button type="submit" class="btn btn-edit">Update</button>
    </form>
    </div>
</body>
</html>
