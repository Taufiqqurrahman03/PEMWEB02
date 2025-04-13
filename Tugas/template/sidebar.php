<?php
$menus = [
    [
        "icon" => "building",
        "label" => "kelurahan",
        "items" => [
         [
            "link" => "list-kelurahan.php",
            "label" => "list kelurahan"
         ],  
         [
            "link" => "form-kelurahan.php",
            "label" => "Tambah" 
         ],
        ]

    ],
    [
        "icon" => "users",
        "label" => "pasien",
        "items" => [
         [
            "link" => "list-pasien.php",
            "label" => "list Pasien"
         ],  
         [
            "link" => "form-pasien.php",
            "label" => "Tambah" 
         ],
        ]
 
    ],

]
?>



<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">PW<sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Pages Collapse  Menu -->
 <?php 
 foreach ($menus as $menu) :
 ?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#<?= $menu['label']?>"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-<?= $menu['icon']; ?>"></i>
        <span><?= $menu['label']; ?></span>
    </a>
    <div id="<?= $menu['label']?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <?php
            foreach ($menu['items'] as $item) :
            ?>
            <a class="collapse-item" href="<?= $item['link'] ?> "><?=  $item['label']; ?></a>
            <?php
            endforeach;
            ?>

        </div>
    </div>
</li>
<?php 
endforeach;
?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>