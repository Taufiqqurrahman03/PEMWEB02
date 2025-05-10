<?php ob_start(); ?>

<h2 class="text-2xl font-bold mb-6">Tambah Armada</h2>

<form action="/rental_app/armada/store" method="POST" class="space-y-4 max-w-xl">
  <input name="merk" type="text" placeholder="Merk Kendaraan" required class="w-full border px-4 py-2 rounded">
  <input name="nopol" type="text" placeholder="Nomor Polisi" required class="w-full border px-4 py-2 rounded">
  <input name="thn_beli" type="number" placeholder="Tahun Beli" required class="w-full border px-4 py-2 rounded">
  <textarea name="deskripsi" placeholder="Deskripsi Kendaraan" class="w-full border px-4 py-2 rounded"></textarea>
  <input name="kapasitas_kursi" type="number" placeholder="Kapasitas Kursi" class="w-full border px-4 py-2 rounded">
  <input name="rating" type="number" placeholder="Rating (1-5)" class="w-full border px-4 py-2 rounded">
  <input name="jenis_kendaraan_id" type="number" placeholder="ID Jenis Kendaraan" class="w-full border px-4 py-2 rounded">
  <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
</form>

<?php
$content = ob_get_clean();
$title = "Tambah Armada";
include __DIR__ . '/../layout/master.php';
?>
