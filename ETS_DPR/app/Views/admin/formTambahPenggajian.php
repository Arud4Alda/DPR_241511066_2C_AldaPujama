<!DOCTYPE html>
<html>
<head>
    <title>Tambah Penggajian DPR</title>
</head>
<body     
    data-flash-error="<?= session()->getFlashdata('error') ?>">
    <div class="form-box">
    <h3 style="text-align: center;">Form Tambah Penggajian DPR</h3>
    <form id="penggajianTambahForm" method="post" action="<?= site_url('admin/penggajian/simpan') ?>" novalidate>
        <div id="formStatusMessage"></div>

        <label for="id_anggota">Pilih Anggota:</label><br>
        <select name="id_anggota" id="id_anggota" required>
            <option value="">-- Pilih Anggota --</option>
            <?php foreach ($anggota as $a): ?>
                <option value="<?= $a['id_anggota'] ?>"><?= $a['nama_depan'] . ' ' . $a['nama_belakang'] ?> (<?= $a['jabatan'] ?>)</option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="id_komponen_gaji">Pilih Komponen Gaji:</label><br>
        <select name="id_komponen_gaji" id="id_komponen_gaji" required>
            <option value="">-- Pilih Komponen Gaji --</option>
            <?php foreach ($komponen_gaji as $g): ?>
                <option value="<?= $g['id_komponen_gaji'] ?>" data-jabatan="<?= $g['jabatan'] ?>">
                    <?= $g['nama_komponen'] ?> - Rp <?= number_format($g['nominal'],0,',','.') ?> (<?= $g['jabatan'] ?>)
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" class="btn btn-edit">Simpan</button>
        
    </form>
    <script>
    // filter komponen sesuai jabatan anggota
    document.getElementById('id_anggota').addEventListener('change', function () {
        let jabatanAnggota = this.options[this.selectedIndex].text.match(/\((.*?)\)/)[1]; 
        let options = document.querySelectorAll('#id_komponen_gaji option');

        options.forEach(opt => {
            let jabatanKomponen = opt.getAttribute('data-jabatan');
            if (!jabatanKomponen) return;
            if (jabatanKomponen === 'Semua' || jabatanKomponen === jabatanAnggota) {
                opt.style.display = 'block';
            } else {
                opt.style.display = 'none';
            }
        });
    });
    </script>
  </body>
</html>



