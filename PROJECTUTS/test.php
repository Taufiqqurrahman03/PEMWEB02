<?php
session_start();
$_SESSION['id'] = 1;
$_SESSION['username'] = 'test';
include 'template/header.php';
include 'template/sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h1>Test Page</h1>
    </div>
  </div>
</div>
<?php include 'template/footer.php'; ?>
