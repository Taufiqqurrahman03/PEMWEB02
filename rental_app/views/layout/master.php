<!-- views/layout/master.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Rental App' ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <?php include __DIR__ . '/sidebar.php'; ?>

  <main class="ml-64 p-6">
    <?= $content ?>
  </main>

</body>
</html>
