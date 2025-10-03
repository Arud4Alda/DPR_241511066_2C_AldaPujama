<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota DPR</title>
</head>
<body>
    <div class="form-box">
    <h3 style="text-align: center;">Form Edit Anggota DPR</h3>
    <form id="dprEditForm" method="post" action="<?= site_url('admin/dpr/update/'.$anggota['id_anggota']) ?>" novalidate>   
        <div id="formStatusMessage"></div>
        <label for="id_anggota">Id Anggota:</label><br>
        <input type="number" name="id_anggota" id="id_anggota" value="<?= $anggota['id_anggota'] ?>" required><br><br>

        <label for="nama_depan">Nama Depan:</label><br>
        <input type="text" name="nama_depan" id="nama_depan" value="<?= $anggota['nama_depan'] ?>" required><br><br>

        <label for="nama_belakang">Nama Belakang:</label><br>
        <input type="text" name="nama_belakang" id="nama_belakang" value="<?= $anggota['nama_belakang'] ?>" required><br><br>

        <label for="gelar_depan">Gelar Depan:</label><br>
        <input type="text" name="gelar_depan" id="gelar_depan" value="<?= $anggota['gelar_depan'] ?>"><br><br>

        <label for="gelar_belakang">Gelar Belakang:</label><br>
        <input type="text" name="gelar_belakang" id="gelar_belakang" value="<?= $anggota['gelar_belakang'] ?>"><br><br>

        <label for="jabatan">Jabatan:</label><br>
        
        <select id="jabatan" name="jabatan" value="<?= $anggota['jabatan'] ?>">
            <option value="Ketua" <?= ($anggota['jabatan'] == 'Ketua') ? 'selected' : '' ?>>Ketua</option>
            <option value="Wakil Ketua" <?= ($anggota['jabatan'] == 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
            <option value="Anggota" <?= ($anggota['jabatan'] == 'Anggota') ? 'selected' : '' ?>>Anggota</option>
        </select><br><br>

        <label for="status_pernikahan">Status Pernikahan:</label><br>
        <select id="status_pernikahan" name="status_pernikahan" value="<?= $anggota['status_pernikahan'] ?>">
            <option value="Kawin" <?= ($anggota['status_pernikahan'] == 'Kawin') ? 'selected' : '' ?>>Kawin</option>
            <option value="Belum Kawin" <?= ($anggota['status_pernikahan'] == 'Belum Kawin') ? 'selected' : '' ?>>Belum Kawin</option>
            <option value="Cerai Hidup" <?= ($anggota['status_pernikahan'] == 'Cerai Hidup') ? 'selected' : '' ?>>Cerai Hidup</option>
        </select><br><br>

        <button type="submit" class="btn btn-edit">Update</button>
    </form>
    </div>
</body>
</html>
