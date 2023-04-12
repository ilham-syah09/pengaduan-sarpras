<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/dataTables.bootstrap4.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/buttons.bootstrap4.min.css') ?>" type="text/css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/toastr/toastr.min.css">

    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <div class="toastr-success" data-flashdata="<?= $this->session->flashdata('toastr-success'); ?>"></div>
        <div class="toastr-error" data-flashdata="<?= $this->session->flashdata('toastr-error'); ?>"></div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <?php if ($this->session->userdata('log_admin')) : ?>

                            <div class="notif">

                            </div>

                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning" id="notifikasi"></span>

                        <?php endif; ?>
                    </a>
                </li>
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="mr-2 d-lg-inline text-dark"><?= $this->dt_user->nama; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <?php $this->load->view($navbar); ?>

        <?php $this->load->view($page); ?>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Logout" untuk keluar dari halaman</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; Sistem Informasi Pengaduan Mahasiswa </strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->

    <!-- Datatables -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/datatable/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatable/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatable/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatable/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatable/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatable/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatable/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatable/buttons.colVis.min.js"></script>

    <script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/toastr/customScript.js"></script>

    <script src="<?= base_url('assets/plugins/jquery.maskedinput/'); ?>jquery.maskedinput.min.js"></script>

    <!-- Summernote -->
    <script src="<?= base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>

    <script>
        $('#example').DataTable();

        var table = $('#examples').DataTable({
            lengthChange: false,
            pageLength: 25,
            buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
            columnDefs: [{
                visible: false
            }]
        });

        table.buttons().container()
            .appendTo('#examples_wrapper .col-md-6:eq(0)');

        $('.js-masked-time').mask('99:99');

        $(function() {
            // Summernote
            $('#summernote').summernote({
                height: 300
            })
        })

        function notif() {
            $.ajax({
                type: "post",
                url: "<?= base_url('admin/home/realtimeNotif'); ?>",
                dataType: "json",
                success: function(response) {
                    if (response.notif > 0) {
                        $('#notifikasi').text(response.notif)
                    } else {
                        $('#notifikasi').text('')
                    }
                    setTimeout(notif, 2000)
                }
            });
        }

        notif();
    </script>
</body>

</html>