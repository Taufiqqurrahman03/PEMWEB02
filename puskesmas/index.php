<?php
require_once 'dbkoneksi.php';

$jml_paramedik = $dbh->query("SELECT COUNT(*) FROM paramedik")->fetchColumn();
$jml_pasien = $dbh->query("SELECT COUNT(*) FROM pasien")->fetchColumn();
$jml_periksa = $dbh->query("SELECT COUNT(*) FROM periksa")->fetchColumn();
$jml_kelurahan = $dbh->query("SELECT COUNT(*) FROM kelurahan")->fetchColumn();

ob_start();
?>
<h1 class="text-2xl font-bold mb-6 text-primary-700"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <div class="bg-primary-100 border-l-4 border-primary-600 p-4 rounded shadow-md hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm text-gray-700">Total Paramedik</h3>
                <p class="text-2xl font-bold text-primary-700"><?= $jml_paramedik ?></p>
            </div>
            <i class="fas fa-user-nurse fa-2x text-primary-600"></i>
        </div>
    </div>

    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-md hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm text-gray-700">Total Pasien</h3>
                <p class="text-2xl font-bold text-red-500"><?= $jml_pasien ?></p>
            </div>
            <i class="fas fa-user-injured fa-2x text-red-500"></i>
        </div>
    </div>

    <div class="bg-red-100 border-l-4 border-red-600 p-4 rounded shadow-md hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm text-gray-700">Total Pemeriksaan</h3>
                <p class="text-2xl font-bold text-red-600"><?= $jml_periksa ?></p>
            </div>
            <i class="fas fa-notes-medical fa-2x text-red-600"></i>
        </div>
    </div>

    <div class="bg-red-50 border-l-4 border-primary-800 p-4 rounded shadow-md hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm text-gray-700">Total Kelurahan</h3>
                <p class="text-2xl font-bold text-primary-800"><?= $jml_kelurahan ?></p>
            </div>
            <i class="fas fa-map-marker-alt fa-2x text-primary-800"></i>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = "Dashboard Puskesmas";
include 'layout.php';
?>