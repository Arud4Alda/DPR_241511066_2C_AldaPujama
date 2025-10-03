<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota DPR</title>
</head>
<body>
    <div class="form-box">
    <h3 style="text-align: center;">Form Tambah Anggota DPR</h3>
    <form id="dprTambahForm" method="post" action="<?= site_url('admin/dpr/simpan') ?>" novalidate>
        <div id="formStatusMessage"></div>
        <label for="id_anggota">Id Anggota:</label><br>
        <input type="number" name="id_anggota" id="id_anggota" required><br><br>

        <label for="nama_depan">Nama Depan:</label><br>
        <input type="text" name="nama_depan" id="nama_depan" required><br><br>

        <label for="nama_belakang">Nama Belakang:</label><br>
        <input type="text" name="nama_belakang" id="nama_belakang" required><br><br>

        <label for="gelar_depan">Gelar Depan:</label><br>
        <input type="text" name="gelar_depan" id="gelar_depan"><br><br>

        <label for="gelar_belakang">Gelar Belakang:</label><br>
        <input type="text" name="gelar_belakang" id="gelar_belakang"><br><br>

        <label for="jabatan">Jabatan:</label><br>
        <select id="jabatan" name="jabatan">
            <option value="Ketua">Ketua</option>
            <option value="Wakil Ketua">Wakil Ketua</option>
            <option value="Anggota">Anggota</option>
        </select><br><br>

        <label for="status_pernikahan">Satus Pernikahan:</label><br>
        <select id="status_pernikahan" name="status_pernikahan">
            <option value="Kawin">Kawin</option>
            <option value="Belum Kawin">Belum Kawin</option>
            <option value="Cerai Hidup">Cerai Hidup</option>
        </select><br><br>

        <button type="submit" class="btn btn-edit">Simpan</button>
        </div>
        </div>
    </form>
  </body>
</html>
