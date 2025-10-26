<!DOCTYPE html>
<html>

<head>
    <!-- Title -->
    <title>Pengaturan Navbar</title>

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
    <link href="<?php echo base_url() . 'assets/plugins/toastr/jquery.toast.min.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/plugins/summernote-master/summernote.css' ?>" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="<?php echo base_url() . 'assets/css/modern.min.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/css/themes/dark.css' ?>" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() . 'assets/css/custom.css' ?>" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url() . 'assets/plugins/3d-bold-navigation/js/modernizr.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/offcanvasmenueffects/js/snap.svg-min.js' ?>"></script>


</head>

<body class="page-header-fixed  compact-menu  pace-done page-sidebar-fixed">
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
                    <a href="<?php echo site_url('backend/dashboard'); ?>" class="logo-text"><span>SIPBS</span></a>
                </div><!-- Logo Box -->
                <div class="search-button">
                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                </div>
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
                                    <li role="presentation"><a href="<?php echo site_url('backend/changepass'); ?>"><i class="fa fa-key"></i>Ganti Password</a></li>
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
                                        <?php if ($row['user_level'] == '1'): ?>
                                            <small>Administrator</small>
                                        <?php else: ?>
                                            <small>Author</small>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </a>
                        <?php else: ?>
                            <a href="javascript:void(0);">
                                <div class="sidebar-profile-image">
                                    <img src="<?php echo base_url() . 'assets/images/user_blank.png'; ?>" class="img-circle img-responsive" alt="">
                                </div>
                                <div class="sidebar-profile-details">
                                    <span><?php echo session()->get('name'); ?><br>
                                        <?php if ($row['user_level'] == '1'): ?>
                                            <small>Administrator</small>
                                        <?php else: ?>
                                            <small>Author</small>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <ul class="menu accordion-menu">
                    <li><a href="<?php echo site_url('backend/system'); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span>
                            <p>Sistem</p>
                        </a></li>
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon icon-pin"></span>
                            <p>Berita</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo site_url('backend/post/add_new'); ?>">Tambah Berita</a></li>
                            <li><a href="<?php echo site_url('backend/post'); ?>">List Berita</a></li>
                            <li><a href="<?php echo site_url('backend/category'); ?>">Kategori</a></li>
                            <li><a href="<?php echo site_url('backend/tag'); ?>">Tag</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo site_url('backend/inbox'); ?>" class="waves-effect waves-button"><span class="menu-icon icon-envelope"></span>
                            <p>Pesan</p>
                        </a></li>
                    <li><a href="<?php echo site_url('backend/comment'); ?>" class="waves-effect waves-button"><span class="menu-icon icon-bubbles"></span>
                            <p>Komen</p>
                        </a></li>

                    <li><a href="<?php echo site_url('backend/testimonial'); ?>" class="waves-effect waves-button"><span class="menu-icon icon-like"></span>
                            <p>Testimonial</p>
                        </a></li>
                    <?php if (session()->get('access') == '1') : ?>
                        <li><a href="<?php echo site_url('backend/users'); ?>" class="waves-effect waves-button"><span class="menu-icon icon-user"></span>
                                <p>Pengguna</p>
                            </a></li>
                        <li class="droplink active open"><a href="<?php echo site_url('backend/settings'); ?>" class="waves-effect waves-button"><span class="menu-icon icon-settings"></span>
                                <p>Pengaturan</p><span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('backend/settings'); ?>">Site</a></li>
                                <li><a href="<?php echo site_url('backend/homesetting'); ?>">Beranda</a></li>
                                <li><a href="<?php echo site_url('backend/aboutsetting'); ?>">Tentang</a></li>
                                <li class="active"><a href="<?php echo site_url('backend/navbar'); ?>">Navbar</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                    <?php endif; ?>
                    <li><a href="<?php echo site_url('logout'); ?>" class="waves-effect waves-button"><span class="menu-icon icon-logout"></span>
                            <p>Log Out</p>
                        </a></li>

                </ul>
            </div><!-- Page Sidebar Inner -->
        </div><!-- Page Sidebar -->
        <div class="page-inner">
            <div class="page-title">
                <h3>Pengaturan Navbar</h3>
                <div class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('backend/system'); ?>">Sistem</a></li>
                        <li><a href="#">Pengaturan</a></li>
                        <li class="active">Pengaturan Navbar</li>
                    </ol>
                </div>
            </div>
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">

                            <div class="panel-body">
                                <button type="button" class="btn btn-success m-b-sm" data-toggle="modal" data-target="#myModal">Tambah Menu</button>
                                <?php foreach ($data as $row): ?>
                                    <div class="row">
                                        <div class="col-md-8" style="margin-top: 10px;">

                                            <div class="input-group">
                                                <button class="btn btn-secondary btn-block"><?php echo strtoupper($row['navbar_name']); ?></button>
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                        <li><a href="#" class="btn-submenu" data-nav_id="<?php echo $row['navbar_id']; ?>">Tambah Sub Menu</a></li>
                                                        <li><a href="#" class="btn-edit-menu" data-nav_id="<?php echo $row['navbar_id']; ?>" data-nav_name="<?php echo $row['navbar_name']; ?>" data-nav_slug="<?php echo $row['navbar_slug']; ?>">Ubah</a></li>
                                                        <li><a href="#" class="btn-delete-menu" data-nav_id="<?php echo $row['navbar_id']; ?>">Hapus</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <?php
                                    $navbar_id = $row['navbar_id'];
                                    $db = \Config\Database::connect();
                                    $query = $db->query("SELECT * FROM tbl_navbar WHERE navbar_parent_id='$navbar_id'");
                                    $result = $query->getResult();
                                    foreach ($result as $i) :
                                    ?>
                                        <div class="row">
                                            <div class="col-md-7 col-md-offset-1 col-sm-offset-1" style="margin-top: 10px;">

                                                <div class="input-group">
                                                    <button class="btn btn-secondary btn-block"><?php echo strtoupper($i->navbar_name); ?></button>
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                            <li><a href="#" class="btn-edit-menu" data-nav_id="<?php echo $i->navbar_id; ?>" data-nav_name="<?php echo $i->navbar_name; ?>" data-nav_slug="<?php echo $i->navbar_slug; ?>">Edit</a></li>
                                                            <li><a href="#" class="btn-delete-menu" data-nav_id="<?php echo $i->navbar_id; ?>">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>

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


    <!-- Modal Add Menu-->
    <form id="add-row-form" action="<?php echo base_url() . 'backend/navbar/insert' ?>" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Menu</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Label</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Label Name" required>
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <div class="input-group m-b-sm">
                                        <span class="input-group-addon" id="basic-addon1"><?php echo site_url(); ?></span>
                                        <input type="text" name="slug" class="form-control" placeholder="Slug" aria-describedby="basic-addon1">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Add Menu-->
    <form id="add-row-form" action="<?php echo base_url() . 'backend/navbar/insertSubmenu' ?>" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="ModalSubmenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Sub Menu</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Label</label>
                                    <input type="text" name="name_submenu" class="form-control" placeholder="Label Name" required>
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <div class="input-group m-b-sm">
                                        <span class="input-group-addon" id="basic-addon1"><?php echo site_url(); ?></span>
                                        <input type="text" name="slug_submenu" class="form-control" placeholder="Slug" aria-describedby="basic-addon1">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                        <input type="hidden" name="id_submenu" class="id_submenu" required>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Edit Menu-->
    <form id="add-row-form" action="<?php echo base_url() . 'backend/navbar/update' ?>" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="ModalEditMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ubah Menu</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Label</label>
                                    <input type="text" name="name_edit" class="form-control name_edit" placeholder="Label Name" required>
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <div class="input-group m-b-sm">
                                        <span class="input-group-addon" id="basic-addon1"><?php echo site_url(); ?></span>
                                        <input type="text" name="slug_edit" class="form-control slug_edit" placeholder="Slug" aria-describedby="basic-addon1">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                        <input type="hidden" name="navbar_id" class="navbar_id" required>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Delete Menu-->
    <form id="add-row-form" action="<?php echo base_url() . 'backend/navbar/delete' ?>" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="ModalDeleteMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Menu</h4>
                    </div>
                    <div class="modal-body">

                        <strong>Anda yakin mau menghapus menu ini?</strong>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                        <input type="hidden" name="id_delete" class="id_delete" required>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Javascripts -->
    <script src="<?php echo base_url() . 'assets/plugins/jquery/jquery-2.1.4.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/jquery-ui/jquery-ui.min.js' ?>"></script>
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
    <script src="<?php echo base_url() . 'assets/js/modern.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/toastr/jquery.toast.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/summernote-master/summernote.min.js' ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn-edit-menu').on('click', function() {
                var navbar_id = $(this).data('nav_id');
                var navbar_name = $(this).data('nav_name');
                var navbar_slug = $(this).data('nav_slug');
                $('#ModalEditMenu').modal('show');
                $('.name_edit').val(navbar_name);
                $('.slug_edit').val(navbar_slug);
                $('.navbar_id').val(navbar_id);
            });

            $('.btn-delete-menu').on('click', function() {
                var navbar_id = $(this).data('nav_id');
                $('#ModalDeleteMenu').modal('show');
                $('.id_delete').val(navbar_id);
            });

            $('.btn-submenu').on('click', function() {
                var navbar_id = $(this).data('nav_id');
                $('#ModalSubmenu').modal('show');
                $('.id_submenu').val(navbar_id);
            });
        });
    </script>
    <!--Toast Message-->
    <?php if (session()->getFlashdata('msg') == 'success'): ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "New Navbar Saved!",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'info'): ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Info',
                text: "Navbar updated!",
                showHideTransition: 'slide',
                icon: 'info',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#00C9E6'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-hapus'): ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Navbar Deleted!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php else: ?>

    <?php endif; ?>

</body>

</html>