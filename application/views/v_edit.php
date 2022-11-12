<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url();?>public/css/style.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="<?php echo base_url();?>public/img/logo_umara.png" rel="icon">

    <title>UMARA</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
        <div class="container">
        <a class="navbar-brand">
            <h1>UMARA</h1>
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Database</a>
                    <a class="nav-link" href="http://umara.my.id" target="_blank">Homepage UMARA</a>
                </div>
            </div>
            <div class="d-none d-lg-flex align-items-center pl-4">
                <!-- <i class="fa fa-2x fa-mobile-alt text-info mr-3"></i> -->
                <div>
                    <a class="nav-link" href="#">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-4">
                <h4 class="mb-4">Edit Data</h4>
            </div>
            <div class="col-4">
                <?php echo anchor('crud', ' ', 'class="btn btn-close float-md-right"')?>
                <!-- <a class="btn btn-close float-md-right" href="index.html" role="button"></a> -->
                <!-- <button type="submit" class="btn btn-close float-md-right"></button> -->
            </div>
        </div>

        <?php foreach($user as $u){ ?>
        <form action="<?php echo site_url('crud/update');?>" method="POST">
            <div class="row mb-3">
                <label for="fullName" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="hidden" name="id" class="form-control" value="<?php echo $u->id ?>">
                <input type="text" name="nama" class="form-control" value="<?php echo $u->nama ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jurusan" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" value="<?php echo $u->alamat ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="kelamin" class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                <input type="text" name="pekerjaan" class="form-control" value="<?php echo $u->pekerjaan ?>" required>
                </div>
            </div>
            
            <!-- <a class="btn btn-primary" href="/tambah-data/1" role="button">Tambah Data</a> -->
            <button type="submit" class="btn btn-primary">Perbaharui Data</button>
        </form>
        <?php } ?>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>