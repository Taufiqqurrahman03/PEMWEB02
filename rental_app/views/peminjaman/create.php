<?php ob_start(); ?>

<h2 class="text-2xl font-bold mb-6">Form Tambah Peminjaman</h2>

<form action="/rental_app/peminjaman/store" method="POST" class="space-y-4 max-w-2xl">
  <input name="nama_peminjam" type="text" placeholder="Nama peminjam" class="w-full border px-4 py-2 rounded">
  <input name="ktp_peminjam" type="text" placeholder="No. KTP" class="w-full border px-4 py-2 rounded">
  <input name="keperluan_pinjam" type="text" placeholder="Keperluan" class="w-full border px-4 py-2 rounded">
  <label class="block">Tanggal Mulai</label>
  <input name="mulai" type="date" class="w-full border px-4 py-2 rounded">
  <label class="block">Tanggal Selesai</label>
  <input name="selesai" type="date" class="w-full border px-4 py-2 rounded">
  <input name="biaya" type="number" placeholder="Biaya Sewa" class="w-full border px-4 py-2 rounded">
  <input name="armada_id" type="number" placeholder="ID Armada" class="w-full border px-4 py-2 rounded">
  <textarea name="komentar_peminjam" placeholder="Komentar" class="w-full border px-4 py-2 rounded"></textarea>
  <select name="status_pinjam" class="w-full border px-4 py-2 rounded">
    <option value="proses">Proses</option>
    <option value="selesai">Selesai</option>
  </select>

  <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
</form>

<?php
$content = ob_get_clean();
$title = "Tambah Peminjaman";
include __DIR__ . '/../layout/master.php';
?>
