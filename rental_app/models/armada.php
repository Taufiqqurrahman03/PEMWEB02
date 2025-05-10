<?php
require_once __DIR__ . '/../config/database.php';

class Armada {
    public static function all() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM armada");
        return $stmt->fetchAll();
    }

    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM armada WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($data) {
        global $pdo;
        $sql = "INSERT INTO armada (merk, nopol, thn_beli, deskripsi, kapasitas_kursi, rating, jenis_kendaraan_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['merk'],
            $data['nopol'],
            $data['thn_beli'],
            $data['deskripsi'],
            $data['kapasitas_kursi'],
            $data['rating'],
            $data['jenis_kendaraan_id']
        ]);
    }

    public static function update($id, $data) {
        global $pdo;
        $sql = "UPDATE armada SET merk = ?, nopol = ?, thn_beli = ?, deskripsi = ?, kapasitas_kursi = ?, rating = ?, jenis_kendaraan_id = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['merk'],
            $data['nopol'],
            $data['thn_beli'],
            $data['deskripsi'],
            $data['kapasitas_kursi'],
            $data['rating'],
            $data['jenis_kendaraan_id'],
            $id
        ]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM armada WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function count() {
        global $pdo;
        $stmt = $pdo->query("SELECT COUNT(*) FROM armada");
        return $stmt->fetchColumn();
    }
    
}
