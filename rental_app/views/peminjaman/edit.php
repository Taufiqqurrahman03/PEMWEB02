<?php ob_start(); ?>

<h2 class="text-2xl font-bold mb-6">Edit Peminjaman</h2>

<form action="/rental_app/peminjaman/update" method="POST" class="space-y-4 max-w-2xl">
  <input type="hidden" name="id" value="<?= $data['id'] ?>">
  <input name="nama_peminjam" type="text" value="<?= $data['nama_peminjam'] ?>" class="w-full border px-4 py-2 rounded">
  <input name="ktp_peminjam" type="text" value="<?= $data['ktp_peminjam'] ?>" class="w-full border px-4 py-2 rounded">
  <input name="keperluan_pinjam" type="text" value="<?= $data['keperluan_pinjam'] ?>" class="w-full border px-4 py-2 rounded">
  <label class="block">Tanggal Mulai</label>
  <input name="mulai" type="date" value="<?= $data['mulai'] ?>" class="w-full border px-4 py-2 rounded">
  <label class="block">Tanggal Selesai</label>
  <input name="selesai" type="date" value="<?= $data['selesai'] ?>" class="w-full border px-4 py-2 rounded">
  <input name="biaya" type="number" value="<?= $data['biaya'] ?>" class="w-full border px-4 py-2 rounded">
  <input name="armada_id" type="number" value="<?= $data['armada_id'] ?>" class="w-full border px-4 py-2 rounded">
  <textarea name="komentar_peminjam" class="w-full border px-4 py-2 rounded"><?= $data['komentar_peminjam'] ?></textarea>
  <select name="status_pinjam" class="w-full border px-4 py-2 rounded">
    <option value="proses" <?= $data['status_pinjam'] == 'proses' ? 'selected' : '' ?>>Proses</option>
    <option value="selesai" <?= $data['status_pinjam'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
  </select>
  <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
</form>

<?php
$content = ob_get_clean();
$title = "Edit Peminjaman";
include __DIR__ . '/../layout/master.php';
?>
