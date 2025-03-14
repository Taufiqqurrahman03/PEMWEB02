<?php
include './top.php';
include './menu.php';
?>

<!-- Page content wrapper-->
<div id="page-content-wrapper">
    <?php
    include './navbar.php';
    ?>
    
    <!-- Page content-->
    <div class="container-fluid">
        <h1 class="mt-4">Status Akademik</h1>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Riwayat Nilai</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Nilai</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pemrograman Dasar</td>
                                    <td>3</td>
                                    <td>85</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Basis Data</td>
                                    <td>3</td>
                                    <td>78</td>
                                    <td>B+</td>
                                </tr>
                                <tr>
                                    <td>Analisis dan Perancangan Sistem</td>
                                    <td>3</td>
                                    <td>90</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Jaringan Komputer</td>
                                    <td>3</td>
                                    <td>82</td>
                                    <td>B</td>
                                </tr>
                                <tr>
                                    <td>Statistika</td>
                                    <td>2</td>
                                    <td>88</td>
                                    <td>A</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Perkembangan Studi</h5>
                    </div>
                    <div class="card-body">
                        <p>Saat ini, saya sedang fokus pada pengembangan keterampilan di bidang pemrograman dan analisis sistem. Saya juga aktif mengikuti seminar dan workshop untuk memperluas pengetahuan saya.</p>
                        <p>Berikut adalah beberapa pencapaian yang telah saya raih:</p>
                        <ul>
                            <li>Mendapatkan beasiswa prestasi untuk semester ini.</li>
                            <li>Menjadi anggota aktif dalam UKM Bisclub.</li>
                            <li>Berpartisipasi dalam kompetisi pemrograman tingkat nasional.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include './bottom.php';
?>