<?php
require_once __DIR__ . '/../config/database.php';

class Peminjaman {
    public static function allWithArmada() {
        global $pdo;
        $stmt = $pdo->query("
            SELECT p.*, a.merk 
            FROM peminjaman p
            LEFT JOIN armada a ON a.id = p.armada_id
            ORDER BY p.id DESC
        ");
        return $stmt->fetchAll();
    }

    public static function filterByStatus($status) {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT p.*, a.merk 
            FROM peminjaman p
            LEFT JOIN armada a ON a.id = p.armada_id
            WHERE p.status_pinjam = ?
            ORDER BY p.id DESC
        ");
        $stmt->execute([$status]);
        return $stmt->fetchAll();
    }
    

    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM peminjaman WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($data) {
        global $pdo;
        $sql = "INSERT INTO peminjaman 
            (nama_peminjam, ktp_peminjam, keperluan_pinjam, mulai, selesai, biaya, armada_id, komentar_peminjam, status_pinjam)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['nama_peminjam'],
            $data['ktp_peminjam'],
            $data['keperluan_pinjam'],
            $data['mulai'],
            $data['selesai'],
            $data['biaya'],
            $data['armada_id'],
            $data['komentar_peminjam'],
            $data['status_pinjam']
        ]);
    }

    public static function update($id, $data) {
        global $pdo;
        $sql = "UPDATE peminjaman SET 
            nama_peminjam=?, ktp_peminjam=?, keperluan_pinjam=?, mulai=?, selesai=?, 
            biaya=?, armada_id=?, komentar_peminjam=?, status_pinjam=? 
            WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['nama_peminjam'],
            $data['ktp_peminjam'],
            $data['keperluan_pinjam'],
            $data['mulai'],
            $data['selesai'],
            $data['biaya'],
            $data['armada_id'],
            $data['komentar_peminjam'],
            $data['status_pinjam'],
            $id
        ]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM peminjaman WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function updateStatus($id, $status) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE peminjaman SET status_pinjam = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }

    public static function count() {
        global $pdo;
        $stmt = $pdo->query("SELECT COUNT(*) FROM peminjaman");
        return $stmt->fetchColumn();
    }
    
    
}
