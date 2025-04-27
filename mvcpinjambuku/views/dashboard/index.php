<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Peminjaman Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Sistem Peminjaman Buku</h1>
            <a href="index.php?c=Login&m=logout" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</a>
        </div>

        <!-- Form Peminjaman -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">Form Peminjaman Buku</h2>
            <form id="peminjamanForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">ID Pengguna</label>
                    <input type="text" name="id_peminjaman" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
                    <input type="tel" name="nomor_telepon" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Judul Buku</label>
                    <input type="text" name="judul_buku" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border rounded" required>
                        <option value="Dipinjam">Dipinjam</option>
                        <option value="Dikembalikan">Dikembalikan</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Data Peminjaman -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold mb-4">Data Peminjaman</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">ID Pengguna</th>
                            <th class="px-4 py-2">Nama Peminjam</th>
                            <th class="px-4 py-2">Nomor Telepon</th>
                            <th class="px-4 py-2">Judul Buku</th>
                            <th class="px-4 py-2">Tanggal Pinjam</th>
                            <th class="px-4 py-2">Tanggal Kembali</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelPeminjaman">
                        <!-- Data akan diisi melalui JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-xl font-bold mb-4">Edit Peminjaman</h3>
            <form id="editForm" class="space-y-4">
                <input type="hidden" id="edit_id_peminjaman" name="id_peminjaman">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Peminjam</label>
                    <input type="text" id="edit_nama_peminjam" name="nama_peminjam" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="tel" id="edit_nomor_telepon" name="nomor_telepon" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Buku</label>
                    <input type="text" id="edit_judul_buku" name="judul_buku" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                    <input type="date" id="edit_tanggal_pinjam" name="tanggal_pinjam" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
                    <input type="date" id="edit_tanggal_kembali" name="tanggal_kembali" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="edit_status" name="status" class="w-full px-3 py-2 border rounded" required>
                        <option value="Dipinjam">Dipinjam</option>
                        <option value="Dikembalikan">Dikembalikan</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>