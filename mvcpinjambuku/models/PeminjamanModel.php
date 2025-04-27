<?php

class PeminjamanModel extends Model {
    public function getAll() {
        $stmt = $this->query("SELECT * FROM peminjaman ORDER BY tanggal_pinjam DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->query("SELECT * FROM peminjaman WHERE id_peminjaman = ?", [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $sql = "INSERT INTO peminjaman (id_peminjaman, nama_peminjam, nomor_telepon, 
                judul_buku, tanggal_pinjam, tanggal_kembali, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        return $this->query($sql, [
            $data['id_peminjaman'],
            $data['nama_peminjam'],
            $data['nomor_telepon'],
            $data['judul_buku'],
            $data['tanggal_pinjam'],
            $data['tanggal_kembali'],
            $data['status']
        ]);
    }
    
    public function update($data) {
        $sql = "UPDATE peminjaman SET 
                nama_peminjam = ?, 
                nomor_telepon = ?, 
                judul_buku = ?, 
                tanggal_pinjam = ?, 
                tanggal_kembali = ?, 
                status = ? 
                WHERE id_peminjaman = ?";
        
        return $this->query($sql, [
            $data['nama_peminjam'],
            $data['nomor_telepon'],
            $data['judul_buku'],
            $data['tanggal_pinjam'],
            $data['tanggal_kembali'],
            $data['status'],
            $data['id_peminjaman']
        ]);
    }
    
    public function delete($id) {
        return $this->query("DELETE FROM peminjaman WHERE id_peminjaman = ?", [$id]);
    }
}