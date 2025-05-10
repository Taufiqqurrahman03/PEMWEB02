<?php
session_start();
$base_url = "/pemweb2/puskesmas/";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Puskesmas App' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            100: '#fee2e2',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Top Navbar -->
    <div class="bg-primary-700 text-white px-6 py-3 shadow">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center">
            <div class="text-xl font-bold text-white">
                APLIKASI PUSKESMAS 
            </div>

            <!-- Avatar Dropdown -->
            <div class="relative group">
                <div class="flex items-center gap-3 cursor-pointer group-hover:opacity-80">
                    <img src="<?= $base_url ?>assets/user.png" alt="user" class="w-8 h-8 rounded-full border border-gray-100">
                    <span class="font-semibold"><?= $_SESSION['username'] ?? 'Guest' ?></span>
                    <i class="fas fa-chevron-down text-sm mt-1"></i>
                </div>

                <!-- DROPDOWN -->
                <div class="absolute right-0 mt-2 w-40 bg-white rounded shadow-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition duration-150 z-50 text-gray-700">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 text-sm">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <a href="<?= $base_url ?>logout.php" class="block px-4 py-2 hover:bg-primary-100 text-sm text-red-600">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white h-screen shadow-md">
            <div class="p-6">
                <h2 class="text-lg font-bold mb-4 text-primary-600">MENU</h2>
                <ul class="space-y-3">
                    <li><a href="<?= $base_url ?>index.php" class="flex items-center gap-2 text-gray-700 hover:text-primary-600"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="<?= $base_url ?>paramedik/data_paramedik.php" class="flex items-center gap-2 text-gray-700 hover:text-primary-600"><i class="fas fa-user-nurse"></i> Paramedik</a></li>
                    <li><a href="<?= $base_url ?>pasien/data_pasien.php" class="flex items-center gap-2 text-gray-700 hover:text-primary-600"><i class="fas fa-user-injured"></i> Pasien</a></li>
                    <li><a href="<?= $base_url ?>periksa/data_periksa.php" class="flex items-center gap-2 text-gray-700 hover:text-primary-600"><i class="fas fa-notes-medical"></i> Pemeriksaan</a></li>
                    <li><a href="<?= $base_url ?>kelurahan/data_kelurahan.php" class="flex items-center gap-2 text-gray-700 hover:text-primary-600"><i class="fas fa-map-marker-alt"></i> Kelurahan</a></li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <?= $content ?? '' ?>
        </main>
    </div>

</body>
</html>