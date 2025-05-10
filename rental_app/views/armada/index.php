<?php
ob_start();
?>

<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold">Data Armada</h2>
  <a href="/rental_app/armada/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah</a>
</div>

<table class="w-full bg-white shadow rounded">
  <thead class="bg-gray-100">
    <tr>
      <th class="p-2 text-left">Merk</th>
      <th class="p-2 text-left">Nopol</th>
      <th class="p-2 text-left">Tahun</th>
      <th class="p-2 text-left">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($armada as $row): ?>
      <tr class="border-t hover:bg-gray-50">
        <td class="p-2"><?= $row['merk'] ?></td>
        <td class="p-2"><?= $row['nopol'] ?></td>
        <td class="p-2"><?= $row['thn_beli'] ?></td>
        <td class="p-2 space-x-2">
          <a href="/rental_app/armada/edit?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
          <a href="/rental_app/armada/delete?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline">Hapus</a>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php
$content = ob_get_clean();
$title = "Data Armada";
include __DIR__ . '/../layout/master.php';
?>
