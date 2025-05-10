<?php
require_once __DIR__ . '/../models/peminjaman.php';
require_once __DIR__ . '/../models/armada.php';

class PeminjamanController {

    public function index() {
        $data = Peminjaman::allWithArmada();
        include __DIR__ . '/../views/peminjaman/index.php';
    }

    public function create() {
        $armada = Armada::all();
        include __DIR__ . '/../views/peminjaman/create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Peminjaman::create($_POST);
            header('Location: /rental_app/peminjaman');
            exit;
        }
    }

    public function edit($id) {
        $data = Peminjaman::find($id);
        $armada = Armada::all();
        include __DIR__ . '/../views/peminjaman/edit.php';
    }

    public function update($post) {
        Peminjaman::update($post['id'], $post);
        header('Location: /rental_app/peminjaman');
        exit;
    }

    public function delete($id) {
        Peminjaman::delete($id);
        header('Location: /rental_app/peminjaman');
        exit;
    }

    public function setSelesai($id) {
        Peminjaman::updateStatus($id, 'selesai');
        header('Location: /rental_app/peminjaman');
        exit;
    }

    public function status($status) {
        $data = Peminjaman::filterByStatus($status);
        include __DIR__ . '/../views/peminjaman/index.php';
    }
}
