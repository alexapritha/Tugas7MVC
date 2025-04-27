<?php

class DashboardController extends Controller {
    private $peminjamanModel;
    
    public function __construct() {
        parent::__construct();
        $this->peminjamanModel = $this->loadModel('PeminjamanModel');
    }
    
    public function index() {
        $this->loadView('dashboard/index');
    }
    
    public function getAllPeminjaman() {
        header('Content-Type: application/json');
        $peminjaman = $this->peminjamanModel->getAll();
        
        // Format tanggal untuk tampilan
        foreach($peminjaman as &$item) {
            $item['tanggal_pinjam'] = date('Y-m-d', strtotime($item['tanggal_pinjam']));
            $item['tanggal_kembali'] = date('Y-m-d', strtotime($item['tanggal_kembali']));
        }
        
        echo json_encode($peminjaman);
    }
    
    public function getSinglePeminjaman() {
        header('Content-Type: application/json');
        
        if (!isset($_GET['id'])) {
            echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
            return;
        }
        
        $data = $this->peminjamanModel->getById($_GET['id']);
        
        if ($data) {
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    }
    
    public function savePeminjaman() {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode(['success' => false, 'message' => 'Method tidak valid']);
            return;
        }
        
        try {
            $this->peminjamanModel->create($_POST);
            echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    
    public function updatePeminjaman() {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode(['success' => false, 'message' => 'Method tidak valid']);
            return;
        }
        
        try {
            $this->peminjamanModel->update($_POST);
            echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    
    public function deletePeminjaman() {
        header('Content-Type: application/json');
        
        if (!isset($_POST['id'])) {
            echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
            return;
        }
        
        try {
            $result = $this->peminjamanModel->delete($_POST['id']);
            if ($result && $result->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }
}