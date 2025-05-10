<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Dummy login: username: admin, password: admin123
    if ($user == 'admin' && $pass == 'admin123') {
        $_SESSION['username'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Puskesmas</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="flex items-center justify-center h-screen bg-gray-100">
    <form method="POST" class="bg-white p-8 rounded shadow-md w-96 space-y-4 border-t-4 border-primary-600">
        <h2 class="text-xl font-bold text-center text-primary-700">Login Admin</h2>
        <?php if (isset($error)): ?>
            <div class="bg-primary-100 text-primary-700 p-2 rounded"><?= $error ?></div>
        <?php endif; ?>
        <input name="username" type="text" placeholder="Username" class="w-full border px-3 py-2 rounded focus:ring focus:ring-primary-200 focus:border-primary-500 outline-none" required>
        <input name="password" type="password" placeholder="Password" class="w-full border px-3 py-2 rounded focus:ring focus:ring-primary-200 focus:border-primary-500 outline-none" required>
        <button class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2 rounded transition duration-200">Login</button>
    </form>
</body>
</html>