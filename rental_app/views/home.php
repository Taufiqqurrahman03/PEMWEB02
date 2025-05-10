<?php ob_start(); ?>
<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
  <!-- Total Produk -->
  <div class="bg-white rounded shadow p-4 border-l-4 border-blue-500">
    <div class="text-sm text-gray-500">Total armada</div>
    <div class="text-2xl font-bold mt-1"><?= $total_produk ?? 0 ?></div>
  </div>

  <!-- Kategori Toko -->
  <div class="bg-white rounded shadow p-4 border-l-4 border-green-500">
    <div class="text-sm text-gray-500">Peminjam</div>
    <div class="text-2xl font-bold mt-1"><?= $total_kategori ?? 0 ?></div>
  </div>

  <!-- Login Saat Ini -->
  <div class="bg-white rounded shadow p-4 border-l-4 border-red-500">
    <div class="text-sm text-gray-500">Login Saat Ini</div>
    <div class="text-2xl font-bold mt-1">
      <?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['username']) : 'Guest' ?>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
$title = "Dashboard";
include __DIR__ . '/layout/master.php';
?>
