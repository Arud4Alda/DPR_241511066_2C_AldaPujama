<!DOCTYPE html>
<html>
<head>
    <title>Edit Daftar Komponen Gaji Anggota</title>
</head>
<body>
    <div class="form-box">
    <p id="php-error-message" style="display:none;"><?= session()->getFlashdata('error') ?></p>
    <p id="php-success-message" style="display:none;"><?= session()->getFlashdata('success') ?></p>

    <?php if (empty($daftar_komponen)): ?>
            <p style="text-align: center; color: red;">Anggota ini belum memiliki komponen gaji.</p>
    <?php else: ?>

    <h3 style="text-align: center;">Form Edit Komponen Penggajia DPR</h3><br>
    <?php 
        $counter = 1;
        foreach($daftar_komponen as $pgj): 
    ?>
    <form method="post" action="<?= site_url('admin/penggajian/update') ?>" novalidate>   
        <div id="formStatusMessage"></div>

        <input type="hidden" name="id_anggota" value="<?= $pgj['id_anggota'] ?>">
        <input type="hidden" name="id_komponen_lama" value="<?= $pgj['id_komponen_gaji'] ?>">

        <label for="komponen_baru_<?= $counter ?>">
            Komponen <?= $counter++ ?> (Saat Ini: <?= $pgj['nama_komponen'] ?>)
        </label>

        <select id="komponen_baru_<?= $counter ?>" name="id_komponen_baru" required>
            <?php foreach($semua_komponen as $k): ?>
                <option value="<?= $k['id_komponen_gaji'] ?>" 
                    <?= ($pgj['id_komponen_gaji'] == $k['id_komponen_gaji']) ? 'selected' : '' ?>>
                    [<?= $k['id_komponen_gaji'] ?>] <?= $k['nama_komponen'] ?> (<?= $k['kategori'] ?>)
                </option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit" class="btn btn-edit">Update</button><br><br><br>
    </form>
    <?php endforeach; ?>
    <?php endif; ?>
    </div>
</body>
</html>