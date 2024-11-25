// Function untuk menampilkan tabel
function showTable(tableId) {
    // Sembunyikan semua tabel
    document.querySelectorAll('.table-section').forEach(section => {
        section.style.display = 'none';
    });
    // Tampilkan tabel yang dipilih
    document.getElementById(tableId).style.display = 'block';
    
    // Update active state pada menu
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    document.querySelector(`[data-table="${tableId}"]`).classList.add('active');
}

// Function untuk membuka modal
function openModal(type, mode, id = null) {
    const modal = document.getElementById(`modal${type}`);
    const form = modal.querySelector('form');
    const modeInput = document.getElementById(`mode${type}`);
    
    // Reset form
    form.reset();
    
    if(mode === 'add') {
        modeInput.value = 'add';
        document.getElementById(`modalTitle${type}`).textContent = `Tambah ${type}`;
        if(type === 'Peserta') {
            document.getElementById('nim').readOnly = false;
        } else if(type === 'Praktikum') {
            document.getElementById('id_praktikum').readOnly = false;
        } else if(type === 'Ruang') {
            document.getElementById('id_ruang').readOnly = false;
        }
    } else {
        modeInput.value = 'edit';
        document.getElementById(`modalTitle${type}`).textContent = `Edit ${type}`;
        if(type === 'Peserta') {
            document.getElementById('nim').readOnly = true;
            window.location.href = `edit_peserta.php?nim=${id}`;
        } else if(type === 'Praktikum') {
            document.getElementById('id_praktikum').readOnly = true;
            window.location.href = `edit_praktikum.php?id=${id}`;
        } else if(type === 'Ruang') {
            document.getElementById('id_ruang').readOnly = true;
            window.location.href = `edit_ruang.php?id=${id}`;
        }
        return;
    }
    
    modal.style.display = 'block';
}

// Function untuk menutup modal
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Function untuk konfirmasi hapus
function confirmDelete(id, type) {
    if(confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        if(type === 'Peserta') {
            window.location.href = `hapus_peserta.php?nim=${id}`;
        } else if(type === 'Praktikum') {
            window.location.href = `hapus_praktikum.php?id=${id}`;
        } else if(type === 'Ruang') {
            window.location.href = `hapus_ruang.php?id=${id}`;
        }
    }
}

// Event listener saat dokumen sudah siap
document.addEventListener('DOMContentLoaded', function() {
    // Tampilkan tabel default (misalnya 'peserta')
    showTable('peserta');
    
    // Tambahkan event listener untuk menu
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const tableId = this.getAttribute('data-table');
            showTable(tableId);
        });
    });
});

function showSection(sectionId) {
    const sections = document.querySelectorAll('.table-section, .dashboard-section');
    sections.forEach(section => {
        section.style.display = 'none';
    });
    document.getElementById(sectionId).style.display = 'block';
}

function showTable(tableId) {
    showSection(tableId);
}

// Show dashboard by default
window.onload = function() {
    showSection('dashboard');
}