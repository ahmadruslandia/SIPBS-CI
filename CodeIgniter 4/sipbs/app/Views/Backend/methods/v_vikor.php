<!DOCTYPE html>
<html>

<head>

    <!-- Title -->
    <title>Vikor</title>

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
                                    <span class="user-name"><?php echo session()->get('name'); ?><i class="fa fa-angle-down"></i></span>
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
                    <li><a href="<?php echo site_url('Backend/dashboard'); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span>
                            <p>SPK</p>
                        </a></li>
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
                        <li class="droplink active open"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-stats"></span>
                                <p>Perhitungan</p><span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('Backend/calculation/topsis'); ?>">TOPSIS</a></li>
                                <li class="active"><a href="<?php echo site_url('Backend/calculation/vikor'); ?>">VIKOR</a></li>
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
                        <li class="droplink active open"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-stats"></span>
                                <p>Perhitungan</p><span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('Backend/calculation/topsis'); ?>">TOPSIS</a></li>
                                <li class="active"><a href="<?php echo site_url('Backend/calculation/vikor'); ?>">VIKOR</a></li>
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
                <h3>VIKOR</h3>
                <div class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="active">Perhitungan</li>
                        <li><a href="<?php echo site_url('Backend/calculation/vikor'); ?>">VIKOR</a></li>
                    </ol>
                </div>
            </div>
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="panel-heading">Alternatif Kriteria</div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <?php foreach ($criteria as $key => $val) : ?>
                                                    <th><?= $val['nama_criteria'] ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <?php foreach ($vikor->data as $key => $val) : ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <td><?= $alternative[$key]->nama_alternative ?></td>
                                                <?php foreach ($val as $k => $v) : $minmax[$k][$key] = $v ?>
                                                    <td><?= round($v, 3) ?></td>
                                                <?php endforeach ?>
                                            </tr>
                                        <?php endforeach ?>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right">Max</td>
                                                <?php foreach ($vikor->minmax as $key => $val) : ?>
                                                    <td><?= round($val['max'], 3) ?></td>
                                                <?php endforeach ?>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right">Min</td>
                                                <?php foreach ($vikor->minmax as $key => $val) : ?>
                                                    <td><?= round($val['min'], 3) ?></td>
                                                <?php endforeach ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="panel-heading">Normalisasi Matriks</div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <?php foreach ($criteria as $key => $val) : ?>
                                                    <th><?= $key ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <?php foreach ($vikor->normal as $key => $val) : ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <?php foreach ($val as $k => $v) : ?>
                                                    <td><?= round($v, 3) ?></td>
                                                <?php endforeach ?>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="panel-heading">Nilai Utilitas (S) dan Ukuran Regret (R)</div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <?php foreach ($criteria as $key => $val) : ?>
                                                    <th><?= $key ?></th>
                                                <?php endforeach ?>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Bobot</td>
                                                <?php foreach ($vikor->bobot as $key => $val) : ?>
                                                    <td><?= round($val, 4) ?></td>
                                                <?php endforeach ?>
                                                <td>S</td>
                                                <td>R</td>
                                            </tr>
                                        </thead>
                                        <?php foreach ($vikor->terbobot as $key => $val) : ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <?php foreach ($val as $k => $v) : ?>
                                                    <td><?= round($v, 3) ?></td>
                                                <?php endforeach ?>
                                                <td><?= round($vikor->total_s[$key], 3) ?></td>
                                                <td><?= round($vikor->total_r[$key], 3) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tfoot>
                                            <tr>
                                                <td class="text-right" colspan="<?= count($criteria) + 1 ?>">S*</td>
                                                <td><?= round($vikor->nilai_s['max'], 3) ?></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" colspan="<?= count($criteria) + 1 ?>">S-</td>
                                                <td><?= round($vikor->nilai_s['min'], 3) ?></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" colspan="<?= count($criteria) + 1 ?>">R*</td>
                                                <td>&nbsp;</td>
                                                <td><?= round($vikor->nilai_r['max'], 3) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" colspan="<?= count($criteria) + 1 ?>">R-</td>
                                                <td>&nbsp;</td>
                                                <td><?= round($vikor->nilai_r['min'], 3) ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="panel-heading">Perangkingan </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Nilai v</th>
                                                <th>Rank</th>
                                            </tr>
                                        </thead>
                                        <?php foreach ($vikor->rank as $key => $val) :
                                            \App\Helpers\query("UPDATE tb_alternative SET total_vikor='{$vikor->nilai_v[$key]}', rank_vikor='$val' WHERE kode_alternative='$key'");
                                        ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <td><?= $alternative[$key]->nama_alternative ?></td>
                                                <td><?= round($vikor->nilai_v[$key], 3) ?></td>
                                                <td><?= round($vikor->rank[$key], 3) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                                <?php if (session()->get('access') == '1') : ?>
                                    <a class="btn btn-default" href="<?= site_url('Backend/calculation/vikor_cetak') ?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
                                <?php else : ?>
                                <?php endif; ?>
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

</body>

</html>