<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belanja Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            margin: 20px;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .card-title {
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .price-list {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
        }

        .price-list h5 {
            color: white;
            background-color: #0056b3;
        }

        .price-list p {
            color: white;
            background-color: #0056b3;
        }

        .form-section {
            padding-right: 20px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Belanja Online</h5>

            <!-- Grid untuk Form dan Daftar Harga -->
            <div class="row">
                <!-- Form Belanja (Kiri) -->
                <div class="col-md-8 form-section">
                    <form method="POST" action="proses_form.php">
                        <div class="form-group row">
                            <label for="customer" class="col-4 col-form-label">Nama Customer</label>
                            <div class="col-8">
                                <input id="customer" name="customer" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4">Pilih Produk</label>
                            <div class="col-8">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input name="produk" id="produk_0" type="radio" class="custom-control-input" value="TV">
                                    <label for="produk_0" class="custom-control-label">TV</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input name="produk" id="produk_1" type="radio" class="custom-control-input" value="KULKAS">
                                    <label for="produk_1" class="custom-control-label">KULKAS</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input name="produk" id="produk_2" type="radio" class="custom-control-input" value="MESIN CUCI">
                                    <label for="produk_2" class="custom-control-label">MESIN CUCI</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-4 col-form-label">Jumlah Beli</label>
                            <div class="col-8">
                                <input id="jumlah" name="jumlah" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="proses" type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Daftar Harga (Kanan) -->
                <div class="col-md-4">
                    <div class="price-list">
                        <h5>Daftar Harga</h5>
                        <ul>
                            <li>TV: Rp 4.200.000</li>
                            <hr />
                            <li>Kulkas: Rp 3.100.000</li>
                            <hr />
                            <li>MESIN CUCI: Rp 3.800.000</li>
                        </ul>
                        <p><small>Harga Dapat Berubah Setiap Saat</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>