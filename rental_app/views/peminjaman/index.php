<?php ob_start(); ?>
<div class="flex items-center justify-between mb-6">
  <h2 class="text-2xl font-bold">Data Peminjaman</h2>
  <a href="/rental_app/peminjaman/create" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Tambah</a>
</div>

<!-- FILTER STATUS -->
<div class="mb-4 flex gap-2">
  <a href="/rental_app/peminjaman" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 text-sm">Semua</a>
  <a href="/rental_app/peminjaman/proses" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Proses</a>
  <a href="/rental_app/peminjaman/selesai" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">Selesai</a>
</div>

<!-- TABEL DATA -->
<div class="overflow-x-auto">
  <table class="min-w-full bg-white shadow rounded">
    <thead class="bg-gray-100">
      <tr>
        <th class="py-2 px-4 text-left">Nama</th>
        <th class="py-2 px-4 text-left">Tanggal</th>
        <th class="py-2 px-4 text-left">Armada</th>
        <th class="py-2 px-4 text-left">Biaya</th>
        <th class="py-2 px-4 text-left">Status</th>
        <th class="py-2 px-4 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row): ?>
        <tr class="border-b hover:bg-gray-50">
          <td class="py-2 px-4"><?= htmlspecialchars($row['nama_peminjam']) ?></td>
          <td class="py-2 px-4"><?= $row['mulai'] ?> s/d <?= $row['selesai'] ?></td>
          <td class="py-2 px-4"><?= $row['merk'] ?></td>
          <td class="py-2 px-4">Rp<?= number_format($row['biaya'], 0, ',', '.') ?></td>
          <td class="py-2 px-4">
            <?php if ($row['status_pinjam'] == 'proses'): ?>
              <span class="inline-block px-2 py-1 text-xs text-white bg-blue-500 rounded">Proses</span>
            <?php else: ?>
              <span class="inline-block px-2 py-1 text-xs text-white bg-green-500 rounded">Selesai</span>
            <?php endif; ?>
          </td>
          <td class="py-2 px-4 space-x-2">
            <a href="/rental_app/peminjaman/edit?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
            <a href="/rental_app/peminjaman/delete?id=<?= $row['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus?')">Hapus</a>

            <?php if ($row['status_pinjam'] === 'proses'): ?>
              <a href="/rental_app/peminjaman/set-selesai?id=<?= $row['id'] ?>" class="text-green-600 hover:underline" onclick="return confirm('Set status jadi selesai?')">Selesaikan</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php
$content = ob_get_clean();
$title = "Peminjaman";
include __DIR__ . '/../layout/master.php';
?>
