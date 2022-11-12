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
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

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
            <!-- <div class="d-none d-lg-flex align-items-center pl-4"> -->
                <!-- <i class="fa fa-2x fa-mobile-alt text-info mr-3"></i> -->
            <!-- </div> -->
        </div>
    </nav>
    
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-6">
                <h4 class="mb-4">Grafik Data Pengguna UMARA</h4>
            </div>
            <div class="col-6 text-right">
                <?php echo anchor('crud', ' ', 'class="btn btn-close float-md-right"')?>
            </div>
        </div>

        <div id="container2">

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        // Build the chart
        Highcharts.chart('container2', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Perbandingan Pengguna'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Umur',
                colorByPoint: true,

                //format data penduduk kota
                //format data original
                data: [
                    <?php foreach($user as $u): ?>
                        {
                            name: '<?php echo $u->nama; ?>',
                            y: <?php echo rand(18,30); ?>,
                        },
                    <?php endforeach?>
                ]

                /*
                data: [
                        {
                            name: 'Chrome',
                            y: 61.41
                        }, 
                        {
                            name: 'Internet Explorer',
                            y: 11.84
                        }, 
                        {
                            name: 'Firefox',
                            y: '10.85'
                        },
                    ]
                */
            }]
        });
    </script>

</body>
</html>