<!-- Sidebar-->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">Start Bootstrap</div>
    <div class="list-group list-group-flush">
        <?php
        // Array yang berisi item sidebar
        $sidebarItems = [
            ['title' => 'Home', 'link' => 'index.php'],
            ['title' => 'About', 'link' => 'about.php'],
            ['title' => 'Profile', 'link' => 'profile.php'],
            ['title' => 'Status', 'link' => 'status.php'],
        ];

        // Menggunakan foreach untuk menghasilkan item sidebar
        foreach ($sidebarItems as $item) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="' . $item['link'] . '">' . $item['title'] . '</a>';
        }
        ?>
    </div>
</div>

