<?php
// routes.php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    // 🔐 AUTH
    case '/rental_app/':
    case '/rental_app/login':
        require_once __DIR__ . '/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->login();
        break;

    case '/rental_app/process-login':
        require_once __DIR__ . '/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->processLogin();
        break;

    case '/rental_app/logout':
        require_once __DIR__ . '/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->logout();
        break;

    // 🏠 HOME
    case '/rental_app/home':
        require_once __DIR__ . '/controllers/DashboardController.php';
        $ctrl = new DashboardController();
        $ctrl->index();
        break;
    

    // 🚗 ARMADA CRUD
    case '/rental_app/armada':
        require_once __DIR__ . '/controllers/ArmadaController.php';
        $ctrl = new ArmadaController();
        $ctrl->index();
        break;

    case '/rental_app/armada/create':
        require_once __DIR__ . '/controllers/ArmadaController.php';
        $ctrl = new ArmadaController();
        $ctrl->create();
        break;

    case '/rental_app/armada/store':
        require_once __DIR__ . '/controllers/ArmadaController.php';
        $ctrl = new ArmadaController();
        $ctrl->store();
        break;

    case '/rental_app/armada/edit':
        require_once __DIR__ . '/controllers/ArmadaController.php';
        $ctrl = new ArmadaController();
        $ctrl->edit($_GET['id']);
        break;

    case '/rental_app/armada/update':
        require_once __DIR__ . '/controllers/ArmadaController.php';
        $ctrl = new ArmadaController();
        $ctrl->update($_POST);
        break;

    case '/rental_app/armada/delete':
        require_once __DIR__ . '/controllers/ArmadaController.php';
        $ctrl = new ArmadaController();
        $ctrl->delete($_GET['id']);
        break;

    // 📄 PEMINJAMAN CRUD
    case '/rental_app/peminjaman':
    case '/rental_app/peminjaman/':
        require_once __DIR__ . '/controllers/PeminjamanController.php';
        $ctrl = new PeminjamanController();
        $ctrl->index();
        break;

    case '/rental_app/peminjaman/create':
    case '/rental_app/peminjaman/create/':
        require_once __DIR__ . '/controllers/PeminjamanController.php';
        $ctrl = new PeminjamanController();
        $ctrl->create();
        break;

    case '/rental_app/peminjaman/store':
    case '/rental_app/peminjaman/store/':
        require_once __DIR__ . '/controllers/PeminjamanController.php';
        $ctrl = new PeminjamanController();
        $ctrl->store();
        break;

    case '/rental_app/peminjaman/edit':
    case '/rental_app/peminjaman/edit/':
        require_once __DIR__ . '/controllers/PeminjamanController.php';
        $ctrl = new PeminjamanController();
        $ctrl->edit($_GET['id']);
        break;

    case '/rental_app/peminjaman/update':
    case '/rental_app/peminjaman/update/':
        require_once __DIR__ . '/controllers/PeminjamanController.php';
        $ctrl = new PeminjamanController();
        $ctrl->update($_POST);
        break;

    case '/rental_app/peminjaman/delete':
    case '/rental_app/peminjaman/delete/':
        require_once __DIR__ . '/controllers/PeminjamanController.php';
        $ctrl = new PeminjamanController();
        $ctrl->delete($_GET['id']);
        break;

    case '/rental_app/peminjaman/proses':
    case '/rental_app/peminjaman/proses/':
        require_once __DIR__ . '/controllers/PeminjamanController.php';
        $ctrl = new PeminjamanController();
        $ctrl->status('proses');
        break;

    case '/rental_app/peminjaman/selesai':
    case '/rental_app/peminjaman/selesai/':
        require_once __DIR__ . '/controllers/PeminjamanController.php';
        $ctrl = new PeminjamanController();
        $ctrl->status('selesai');
        break;

    case '/rental_app/peminjaman/set-selesai':
        require_once __DIR__ . '/controllers/PeminjamanController.php';
        $ctrl = new PeminjamanController();
        $ctrl->setSelesai($_GET['id']);
        break;

    // 🧱 DEFAULT 404
    default:
        http_response_code(404);
        echo "<h1>404 - Halaman tidak ditemukan</h1>";
        break;
}
