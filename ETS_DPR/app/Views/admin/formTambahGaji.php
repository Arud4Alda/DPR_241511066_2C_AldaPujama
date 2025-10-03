<!DOCTYPE html>
<html>
<head>
    <title>Tambah Komponen Gaji DPR</title>
</head>
<body>
    <div class="form-box">
    <h3 style="text-align: center;">Form Tambah Komponen Gaji DPR</h3>
    <form id="gajiTambahForm" method="post" action="<?= site_url('admin/gaji/simpan') ?>" novalidate>
        <div id="formStatusMessage"></div>
        <label for="id_komponen_gaji">Id Komponen Gaji:</label><br>
        <input type="number" name="id_komponen_gaji" id="id_komponen_gaji" required><br><br>

        <label for="nama_komponen">Nama Komponen:</label><br>
        <input type="text" name="nama_komponen" id="nama_komponen" required><br><br>

        <label for="kategori">Kategori:</label><br>
        <select id="kategori" name="kategori">
            <option value="Gaji Pokok">Gaji Pokok</option>
            <option value="Tunjangan Melekat">Tunjangan Melekat</option>
            <option value="Tunjangan Lain">Tunjangan Lain</option>
        </select><br><br>

        <label for="jabatan">Jabatan:</label><br>
        <select id="jabatan" name="jabatan">
            <option value="Ketua">Ketua</option>
            <option value="Wakil Ketua">Wakil Ketua</option>
            <option value="Anggota">Anggota</option>
            <option value="Semua">Semua</option>
        </select><br><br>

        <label for="nominal">Nominal:</label><br>
        <input type="number" name="nominal" id="nominal" required><br><br>

        <label for="satuan">Satuan:</label><br>
        <select id="satuan" name="satuan" required>
            <option value="Hari">Hari</option>
            <option value="Bulan">Bulan</option>
            <option value="Periode">Periode</option>
        </select><br><br>

        <button type="submit" class="btn btn-edit">Simpan</button>
        
    </form>
  </body>
</html>
