<!DOCTYPE html>
<html>

<head>

    <!-- Title -->
    <title>SPK</title>

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Ahmad Ruslandia Papua" />
    <link rel="shortcut icon" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">

    <!-- Styles -->
    <link href="<?php echo base_url() . 'assets/plugins/pace-master/themes/blue/pace-theme-flash.css' ?>" rel="stylesheet" />
    <link href="<?php echo base_url() . 'assets/plugins/uniform/css/uniform.default.min.css' ?>" rel="stylesheet" />
    <link href="<?php echo base_url() . 'assets/plugins/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/fontawesome/css/font-awesome.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/line-icons/simple-line-icons.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/waves/waves.min.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/switchery/switchery.min.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/3d-bold-navigation/css/style.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/slidepushmenus/css/component.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/datatables/css/jquery.datatables.min.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/datatables/css/jquery.datatables_themeroller.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/bootstrap-datepicker/css/datepicker3.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/select2/css/select2.min.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/toastr/jquery.toast.min.css' ?>" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="<?php echo base_url() . 'assets/css/modern.min.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/css/themes/dark.css' ?>" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/css/custom.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/css/dropify.min.css' ?>" rel="stylesheet" type="text/css">

    <script src="<?php echo base_url() . 'assets/plugins/3d-bold-navigation/js/modernizr.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/offcanvasmenueffects/js/snap.svg-min.js' ?>"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
</head>

<body class="page-header-fixed compact-menu pace-done page-sidebar-fixed">
    <div class="overlay"></div>
    <main class="page-content content-wrap">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="sidebar-pusher">
                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="logo-box">
                    <a href="<?php echo site_url('Backend/dashboard'); ?>" class="logo-text"><span>SIPBS</span></a>
                </div><!-- Logo Box -->
                <div class="topmenu-outer">
                    <div class="top-menu">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                    <span class="user-name" <?php echo session()->get('name'); ?>><i class="fa fa-angle-down"></i></span>
                                    <?php
                                    $user_id = session()->get('id');
                                    $db = \Config\Database::connect();
                                    $query = $db->table('tbl_user')->where('user_id', $user_id)->get();
                                    if ($query->getNumRows() > 0):
                                        $row = $query->getRowArray();
                                    ?>
                                        <img class="img-circle avatar" src="<?php echo base_url() . 'assets/images/' . $row['user_photo']; ?>" width="40" height="40" alt="">
                                    <?php else : ?>
                                        <img class="img-circle avatar" src="<?php echo base_url() . 'assets/images/user_blank.png'; ?>" width="40" height="40" alt="">
                                    <?php endif; ?>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li role="presentation"><a href="<?php echo site_url('Backend/changepass'); ?>"><i class="fa fa-key"></i>Ganti Password</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a href="<?php echo site_url('logout'); ?>"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo site_url('logout'); ?>" class="log-out waves-effect waves-button waves-classic">
                                    <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                                </a>
                            </li>
                        </ul><!-- Nav -->
                    </div><!-- Top Menu -->
                </div>
            </div>
        </div><!-- Navbar -->
        <div class="page-sidebar sidebar">
            <div class="page-sidebar-inner slimscroll">
                <div class="sidebar-header">
                    <div class="sidebar-profile">
                        <?php
                        $user_id = session()->get('id');
                        $db = \Config\Database::connect();
                        $query = $db->table('tbl_user')->where('user_id', $user_id)->get();
                        if ($query->getNumRows() > 0):
                            $row = $query->getRowArray();
                        ?>
                            <a href="javascript:void(0);">
                                <div class="sidebar-profile-image">
                                    <img src="<?php echo base_url() . 'assets/images/' . $row['user_photo']; ?>" class="img-circle img-responsive" alt="">
                                </div>
                                <div class="sidebar-profile-details">
                                    <span><?php echo session()->get('name'); ?><br>
                                        <?php if ($row['user_level'] == '1') : ?>
                                            <small>Administrator</small>
                                        <?php else : ?>
                                            <small>Author</small>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </a>
                        <?php else : ?>
                            <a href="javascript:void(0);">
                                <div class="sidebar-profile-image">
                                    <img src="<?php echo base_url() . 'assets/images/user_blank.png'; ?>" class="img-circle img-responsive" alt="">
                                </div>
                                <div class="sidebar-profile-details">
                                    <span><?php echo session()->get('name'); ?><br>
                                        <?php if ($row['user_level'] == '1') : ?>
                                            <small>Administrator</small>
                                        <?php else : ?>
                                            <small>Author</small>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <ul class="menu accordion-menu">
                    <li class="droplink active open"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span>
                            <p>Dashboard</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="active"><a href="<?php echo site_url('Backend/dashboard'); ?>">SPK</a></li>
                            <li><a href="<?php echo site_url('Backend/system'); ?>">Sistem</a></li>
                        </ul>
                    </li>
                    <?php if (session()->get('access') == '1') : ?>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-pushpin"></span>
                                <p>Kriteria</p><span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('Backend/criteria'); ?>">Kriteria</a></li>
                                <li><a href="<?php echo site_url('Backend/crips'); ?>">Nilai Crips</a></li>
                            </ul>
                        </li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-pencil"></span>
                                <p>Alternatif</p><span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('Backend/alternative'); ?>">Alternatif</a></li>
                                <li><a href="<?php echo site_url('Backend/relation'); ?>">Nilai Alternatif</a></li>
                            </ul>
                        </li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-stats"></span>
                                <p>Perhitungan</p><span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('Backend/calculation/topsis'); ?>">TOPSIS</a></li>
                                <li><a href="<?php echo site_url('Backend/calculation/vikor'); ?>">VIKOR</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-pushpin"></span>
                                <p>Kriteria</p><span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('Backend/criteria'); ?>">Kriteria</a></li>
                                <li><a href="<?php echo site_url('Backend/crips'); ?>">Nilai Crips</a></li>
                            </ul>
                        </li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-pencil"></span>
                                <p>Alternatif</p><span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('Backend/alternative'); ?>">Alternatif</a></li>
                            </ul>
                        </li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-stats"></span>
                                <p>Perhitungan</p><span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('Backend/calculation/topsis'); ?>">TOPSIS</a></li>
                                <li><a href="<?php echo site_url('Backend/calculation/vikor'); ?>">VIKOR</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <li><a href="<?php echo site_url('logout'); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-log-out"></span>
                            <p>Log Out</p>
                        </a></li>
                </ul>
            </div><!-- Page Sidebar Inner -->
        </div><!-- Page Sidebar -->
        <div class="page-inner">
            <div class="page-title">
                <h3>SPK</h3>
                <div class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">SPK</li>
                    </ol>
                </div>
            </div>
            <div id="main-wrapper">
                <div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-white">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="visitors-chart">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Pemeringkatan</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-10">
                                                <canvas id="line"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="visitors-chart">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Grafik</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-10">
                                                <canvas id="pie"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-12">
                        <div class="panel panel-white">

                            <div class="panel-body">

                                <table id="mytable" class="display table" style="width: 100%; cellspacing: 0;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama Alternatif</th>
                                            <th>Keterangan</th>
                                            <th>Total TOPSIS</th>
                                            <th>Total VIKOR</th>
                                            <th>Rank TOPSIS</th>
                                            <th>Rank VIKOR</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $no = 0;
                                    foreach ($rows as $row) : ?>
                                        <tr>
                                            <td><?= ++$no ?></td>
                                            <td><?= $row->kode_alternative ?></td>
                                            <td><?= $row->nama_alternative ?></td>
                                            <td><?= $row->keterangan ?></td>
                                            <td><?= round($row->total_topsis, 4) ?></td>
                                            <td><?= round($row->total_vikor, 4) ?></td>
                                            <td><?= $row->rank_topsis ?></td>
                                            <td><?= $row->rank_vikor ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="stats-info">
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <form class="form-inline">
                                                    <?php if (session()->get('access') == '1') : ?>
                                                        <div class="form-group">
                                                            <a class="btn btn-default" target="_blank" href="<?= site_url('Backend/Calculation/hasil_cetak?search=' . request()->getGet('search')) ?>">
                                                                <span class="glyphicon glyphicon-print"></span> Cetak
                                                            </a>
                                                        </div>
                                                    <?php else : ?>
                                                    <?php endif; ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
            </div><!-- Main Wrapper -->
            <div class="page-footer">
                <p class="no-s"><?php echo date('Y'); ?> &copy; Powered by FIKOM.UMI</p>
            </div>
        </div><!-- Page Inner -->
    </main><!-- Page Content -->
    <div class="cd-overlay"></div>


    <!-- Javascripts -->
    <script src="<?php echo base_url() . 'assets/plugins/jquery/jquery-2.1.4.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/jquery-ui/jquery-ui.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/select2/js/select2.min.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/plugins/pace-master/pace.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/jquery-blockui/jquery.blockui.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/bootstrap/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/switchery/switchery.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/uniform/jquery.uniform.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/offcanvasmenueffects/js/classie.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/offcanvasmenueffects/js/main.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/waves/waves.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/3d-bold-navigation/js/main.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/jquery-mockjax-master/jquery.mockjax.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/moment/moment.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/datatables/js/jquery.datatables.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/modern.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/dropify.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/toastr/jquery.toast.min.js' ?>"></script>

    <script>
        const baseUrl = "<?php echo base_url(); ?>"
        const myChart = (chartType) => {
            $.ajax({
                url: baseUrl + 'Backend/dashboard/chart_data',
                dataType: 'json',
                method: 'get',
                success: data => {
                    let chartX = []
                    let chartY = []
                    data.map(data => {
                        chartX.push(data.nama_alternative)
                        chartY.push((+data.total_topsis) + (-data.total_vikor))
                    })
                    const chartData = {
                        labels: chartX,
                        datasets: [{
                            label: 'Perbandingan Rank',
                            data: chartY,
                            backgroundColor: ['lightcoral'],
                            borderColor: ['lightcoral'],
                            borderWidth: 3.5
                        }],

                    }
                    const ctx = document.getElementById(chartType).getContext('2d')
                    const config = {
                        type: chartType,
                        data: chartData
                    }
                    switch (chartType) {
                        case 'pie':
                            const randomNum = () => Math.floor(Math.random() * (235 - 52 + 1) + 52);
                            //const pieColor = () => `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`;
                            const pieColor = [`rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`,
                                `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`
                            ];

                            chartData.datasets[0].backgroundColor = pieColor
                            chartData.datasets[0].borderColor = ['#ffff']
                            chartData.datasets[0].borderWidth = 2

                            break;
                        case 'line':
                            chartData.datasets[0].backgroundColor = ['#22BAA0']
                            chartData.datasets[0].borderColor = ['#22BAA0']
                            break;
                        default:
                            config.options = {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                    }
                    const chart = new Chart(ctx, config)
                }
            })
        }

        myChart('pie')
        myChart('line')
        myChart('bar')
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#mytable').DataTable();
        });
    </script>


</body>

</html>