// Fungsi untuk merender data anggota dpr ke tabel
function renderDPRTableAdmin(data) {
    const tableBody = document.querySelector('#DPRTable tbody');
    if (!tableBody) return;
    tableBody.innerHTML = '';
    data.forEach(DPR => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${DPR.id_anggota}</td>
            <td>${DPR.nama_depan}</td>
            <td>${DPR.nama_belakang}</td>
            <td>${DPR.gelar_depan}</td>
            <td>${DPR.gelar_belakang}</td>
            <td>${DPR.jabatan}</td>
            <td>${DPR.status_pernikahan}</td>
            <td>
                <a href="${BASE_URL}admin/dpr/edit/${DPR.id_anggota}" class="btn btn-edit">Edit</a>
                <a href="${BASE_URL}admin/dpr/hapus/${DPR.id_anggota}" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ${DPR.nama_depan}?')">Hapus</a>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Fungsi untuk merender data anggota dpr ke tabel client
function renderDPRTableClient(data) {
    const tableBody = document.querySelector('#anggotaDPRTable tbody');
    if (!tableBody) return;
    tableBody.innerHTML = '';
    data.forEach(DPR => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${DPR.id_anggota}</td>
            <td>${DPR.nama_depan}</td>
            <td>${DPR.nama_belakang}</td>
            <td>${DPR.gelar_depan}</td>
            <td>${DPR.gelar_belakang}</td>
            <td>${DPR.jabatan}</td>
            <td>${DPR.status_pernikahan}</td>
        `;
        tableBody.appendChild(row);
    });
}

// Fungsi untuk merender data gaji anggota dpr ke tabel
function renderGajiTable(data) {
    const tableBody = document.querySelector('#gajiTable tbody');
    if (!tableBody) return;
    tableBody.innerHTML = '';
    data.forEach(tgj => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${tgj.id_komponen_gaji}</td>
            <td>${tgj.nama_komponen}</td>
            <td>${tgj.kategori}</td>
            <td>${tgj.jabatan}</td>
            <td>${formatRupiah(tgj.nominal)}</td>
            <td>${tgj.satuan}</td>
            <td>
                <a href="${BASE_URL}admin/gaji/edit/${tgj.id_komponen_gaji}" class="btn btn-edit">Edit</a>
                <a href="${BASE_URL}admin/gaji/hapus/${tgj.id_komponen_gaji}" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ${tgj.nama_komponen}?')">Hapus</a>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Fungsi untuk merender data anggota dpr ke tabel
function renderPenggajianTableAdmin(data) {
    const tableBody = document.querySelector('#penggajianTable tbody');
    if (!tableBody) return;
    tableBody.innerHTML = '';
    data.forEach(pgj => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${pgj.id_anggota}</td>
            <td>${pgj.nama_lengkap}</td>
            <td>${pgj.jabatan}</td>
            <td>${formatRupiah(pgj.take_home_pay)}</td>
            <td>
                <a href="${BASE_URL}admin/penggajian/edit/${pgj.id_anggota}" class="btn btn-edit">Edit</a>
                <a href="${BASE_URL}admin/penggajian/hapus/${pgj.id_anggota}" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ${pgj.nama_lengkap}?')">Hapus</a>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Fungsi untuk merender data anggota dpr ke tabel client
function renderPenggajianTableClient(data) {
    const tableBody = document.querySelector('#dprpenggajianTable tbody');
    if (!tableBody) return;
    tableBody.innerHTML = '';
    data.forEach(pgj => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${pgj.id_anggota}</td>
            <td>${pgj.nama_lengkap}</td>
            <td>${pgj.jabatan}</td>
            <td>${formatRupiah(pgj.take_home_pay)}</td>
        `;
        tableBody.appendChild(row);
    });
}

function formatRupiah(angka) {
    if (!angka) return "Rp 0,00";
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(angka);
}

function showStatusMessage(message, type, targetId) {
    const targetElement = document.getElementById(targetId);
    if (!targetElement) {
        console.error(`Target element with ID '${targetId}' not found.`);
        return;
    }
    
    const statusDiv = document.createElement('div');
    statusDiv.className = 'status-message';
    statusDiv.textContent = message;
    statusDiv.style.padding = '10px';
    statusDiv.style.margin = '10px 0';
    statusDiv.style.color = 'white';
    statusDiv.style.textAlign = 'center';
    statusDiv.style.borderRadius = '5px';
    statusDiv.style.backgroundColor = type === 'success' ? '#4CAF50' : '#f44336';
    
    const oldMessage = targetElement.querySelector('.status-message');
    if (oldMessage) {
        oldMessage.remove();
    }
    targetElement.prepend(statusDiv);

    setTimeout(() => {
        statusDiv.remove();
    }, 4000);
}

function handleFormValidation(formId) {
    const form = document.getElementById(formId);
    if (!form) {
        return;
    }

    form.addEventListener('submit', function(event) {
        let isFormEmpty = false;
        const requiredInputs = form.querySelectorAll('input[required]');

        requiredInputs.forEach(input => {
            input.style.border = '';
        });

        requiredInputs.forEach(input => {
            if (input.value.trim() === '') {
                isFormEmpty = true;
                input.style.border = '2px solid red';
            }
        });

        if (isFormEmpty) {
            event.preventDefault();
            const statusMessageDiv = form.querySelector('#formStatusMessage');
            if (statusMessageDiv) {
                showStatusMessage('Semua field wajib diisi!', 'error', statusMessageDiv.id);
            }
        }
    });
}

function setupActiveMenu(menuSelector) {
    const menuLinks = document.querySelectorAll(menuSelector + ' a');
    if (!menuLinks.length) return;

    const currentUrl = window.location.href;

    menuLinks.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    
     setupActiveMenu('.menu');
    const successMessageEl = document.getElementById('php-success-message');
    const errorMessageEl = document.getElementById('php-error-message');
    //const contentDiv = document.querySelector('.content');

    if (successMessageEl && successMessageEl.textContent.trim() !== '') {
        showStatusMessage(successMessageEl.textContent.trim(), 'success', 'content');
    }
    
    if (errorMessageEl && errorMessageEl.textContent.trim() !== '') {
        showStatusMessage(errorMessageEl.textContent.trim(), 'error', 'content');
    }

    if (typeof anggotaData !== 'undefined') {
        renderDPRTableAdmin(anggotaData); 
        renderDPRTableClient(anggotaData);
    }
    
    if (typeof gajiData !== 'undefined') {
    renderGajiTable(gajiData); 
    }

    if (typeof penggajianData !== 'undefined') {
        renderPenggajianTableAdmin(penggajianData);
        renderPenggajianTableClient(penggajianData);
    }

    // --- Validasi form kosong ---
    
    handleFormValidation('loginForm');// untuk form login
    handleFormValidation('dprTambahForm');  // untuk form tambah DPR
    handleFormValidation('dprEditForm');    // untuk form edit DPR
    handleFormValidation('gajiTambahForm'); // untuk form tambah komponen gaji
    handleFormValidation('gajiEditForm');    // untuk form edit komponen Gaji
    handleFormValidation('penggajianEditForm');    // untuk form edit penggajian
});