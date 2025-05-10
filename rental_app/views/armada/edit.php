<?php ob_start(); ?>

<h2 class="text-2xl font-bold mb-6">Edit Armada</h2>

<form action="/rental_app/armada/update" method="POST" class="space-y-4 max-w-xl">
  <input type="hidden" name="id" value="<?= $data['id'] ?>">
  <input name="merk" type="text" value="<?= $data['merk'] ?>" required class="w-full border px-4 py-2 rounded">
  <input name="nopol" type="text" value="<?= $data['nopol'] ?>" required class="w-full border px-4 py-2 rounded">
  <input name="thn_beli" type="number" value="<?= $data['thn_beli'] ?>" required class="w-full border px-4 py-2 rounded">
  <textarea name="deskripsi" class="w-full border px-4 py-2 rounded"><?= $data['deskripsi'] ?></textarea>
  <input name="kapasitas_kursi" type="number" value="<?= $data['kapasitas_kursi'] ?>" class="w-full border px-4 py-2 rounded">
  <input name="rating" type="number" value="<?= $data['rating'] ?>" class="w-full border px-4 py-2 rounded">
  <input name="jenis_kendaraan_id" type="number" value="<?= $data['jenis_kendaraan_id'] ?>" class="w-full border px-4 py-2 rounded">
  <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
</form>

<?php
$content = ob_get_clean();
$title = "Edit Armada";
include __DIR__ . '/../layout/master.php';
?>
