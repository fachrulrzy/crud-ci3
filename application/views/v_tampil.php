<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
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
                    <a class="nav-link" href="#">Logout</a>
                </div>
            </div>
            <!-- <div class="d-none d-lg-flex align-items-center pl-4"> -->
                <!-- <i class="fa fa-2x fa-mobile-alt text-info mr-3"></i> -->
            <!-- </div> -->
        </div>
    </nav>
    
    <div class="container">
        <!-- <a class="btn btn-primary mb-2" href="tambah-data.html" role="button">Tambah Data</a> -->
        <?php echo anchor('crud/tambah', 'Tambah Data', 'class="btn btn-primary mb-2"')?>
        <?php echo anchor('crud/export_excel', 'Ekspor ke Excel', 'class="btn btn-info mb-2"')?>
        <?php echo anchor('crud/import', 'Impor Excel', 'class="btn btn-secondary mb-2"')?>
        <?php echo anchor('crud/export_pdf', 'Ekspor ke PDF', 'class="btn btn-success mb-2"')?>
        <?php echo anchor('crud/chart', 'Grafik', 'class="btn btn-info mb-2"')?>
        <!-- <h2 class="mt-4 mb-4"><%= title %></h2> -->

        <table class="table table-striped" id="mytable">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>Operasi</th>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($user as $u) {
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $u->nama ?></td>
                    <td><?php echo $u->alamat ?></td>
                    <td><?php echo $u->pekerjaan ?></td>
                    <td>
                        <?php echo anchor('crud/edit/'.$u->id, 'Edit', 'class="btn btn-primary edit"')?>
                        |
                        <?php echo anchor('crud/hapus/'.$u->id, 'Hapus', 'class="btn btn-danger"')?>
                    </td>
                </tr>
                <?php }?>
                <!-- <tr>
                    <td class="text-md-center" colspan="5">Data Kosong</td>
                </tr> -->
            </tbody>
        </table>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#mytable').DataTable();
        } );
    </script>
</body>
</html>