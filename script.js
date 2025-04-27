document.addEventListener('DOMContentLoaded', function() {
    const peminjamanForm = document.getElementById('peminjamanForm');
    if (peminjamanForm) {
        loadPeminjamanData();
        
        peminjamanForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('index.php?c=Dashboard&m=savePeminjaman', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadPeminjamanData();
                    peminjamanForm.reset();
                    alert('Data berhasil disimpan!');
                } else {
                    alert(data.message || 'Gagal menyimpan data!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada sistem');
            });
        });
    }
});

function loadPeminjamanData() {
    fetch('index.php?c=Dashboard&m=getAllPeminjaman')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('tabelPeminjaman');
            tbody.innerHTML = '';
            
            if (Array.isArray(data)) {
                data.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-100';
                    tr.innerHTML = `
                        <td class="border px-4 py-2">${item.id_peminjaman}</td>
                        <td class="border px-4 py-2">${item.nama_peminjam}</td>
                        <td class="border px-4 py-2">${item.nomor_telepon}</td>
                        <td class="border px-4 py-2">${item.judul_buku}</td>
                        <td class="border px-4 py-2">${item.tanggal_pinjam}</td>
                        <td class="border px-4 py-2">${item.tanggal_kembali}</td>
                        <td class="border px-4 py-2">${item.status}</td>
                        <td class="border px-4 py-2">
                            <button type="button" 
                                    onclick="updatePeminjaman('${item.id_peminjaman}')" 
                                    class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded mr-1">
                                Update
                            </button>
                            <button type="button"
                                    onclick="deletePeminjaman('${item.id_peminjaman}')" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                                Delete
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
        });
}

function updatePeminjaman(id) {
    fetch('index.php?c=Dashboard&m=getSinglePeminjaman&id=' + encodeURIComponent(id))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('edit_id_peminjaman').value = data.data.id_peminjaman;
                document.getElementById('edit_nama_peminjam').value = data.data.nama_peminjam;
                document.getElementById('edit_nomor_telepon').value = data.data.nomor_telepon;
                document.getElementById('edit_judul_buku').value = data.data.judul_buku;
                document.getElementById('edit_tanggal_pinjam').value = data.data.tanggal_pinjam;
                document.getElementById('edit_tanggal_kembali').value = data.data.tanggal_kembali;
                document.getElementById('edit_status').value = data.data.status;

                document.getElementById('editModal').classList.remove('hidden');
            } else {
                alert(data.message || 'Gagal mengambil data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada sistem');
        });
}

document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('index.php?c=Dashboard&m=updatePeminjaman', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadPeminjamanData();
            document.getElementById('editModal').classList.add('hidden');
            alert('Data berhasil diperbarui!');
        } else {
            alert(data.message || 'Gagal memperbarui data!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan pada sistem');
    });
});

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function deletePeminjaman(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        const formData = new FormData();
        formData.append('id', id);
        
        fetch('index.php?c=Dashboard&m=deletePeminjaman', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadPeminjamanData();
                alert('Data berhasil dihapus!');
            } else {
                alert(data.message || 'Gagal menghapus data!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada sistem');
        });
    }
}