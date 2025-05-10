<?php
// File: controllers/DashboardController.php
require_once __DIR__ . '/../models/armada.php';
require_once __DIR__ . '/../models/peminjaman.php';

class DashboardController {
    public function index() {
        $total_produk = Armada::count();
        $total_kategori = Peminjaman::count();
        $total_testimoni = 0;

        include __DIR__ . '/../views/home.php';
    }
}
