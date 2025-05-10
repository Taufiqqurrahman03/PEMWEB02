<?php
require_once __DIR__ . '/../models/armada.php';

class ArmadaController {

    public function index() {
        $armada = Armada::all();
        include __DIR__ . '/../views/armada/index.php'; // ✅ fixed
    }

    public function create() {
        include __DIR__ . '/../views/armada/create.php'; // ✅ fixed
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Armada::create($_POST);
            header('Location: /rental_app/armada');
            exit;
        }
    }

    public function edit($id) {
        $data = Armada::find($id);
        include __DIR__ . '/../views/armada/edit.php'; // ✅ fixed
    }

    public function update($data) {
        Armada::update($data['id'], $data);
        header('Location: /rental_app/armada');
        exit;
    }

    public function delete($id) {
        Armada::delete($id);
        header('Location: /rental_app/armada');
        exit;
    }
}
