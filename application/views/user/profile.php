<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-info" role="alert">
                Jika password anda lupa, hubungi admin untuk reset password!
            </div>
            <?php if (password_verify('user123', $this->dt_user->password)) : ?>
                <div class="alert alert-danger" role="alert">
                    Anda masih menggunakan password default, segera ganti password anda!
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('upload/profile/' . $this->dt_user->foto); ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $this->dt_user->nama; ?></h3>

                            <p class="text-muted text-center">Username : <?= $this->dt_user->username; ?></p>

                            <hr>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h4>Setting Profile</h4>
                            <div class="row">
                                <div class="col-5 col-sm-3">
                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Foto</a>
                                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Password</a>
                                    </div>
                                </div>
                                <div class="col-7 col-sm-9">
                                    <div class="tab-content" id="vert-tabs-tabContent">

                                        <!-- tab update foto -->
                                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                            <form action="<?= base_url('user/profile/updateProfile'); ?>" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label>Foto</label>
                                                    <input type="file" name="foto" id="foto" class="form-control">
                                                </div>
                                                <button type="submit" class="btn btn-primary">save</button>
                                            </form>
                                        </div>
                                        <!-- end tab update foto -->

                                        <!-- tab change password -->
                                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                            <?php if (password_verify('user123', $this->dt_user->password)) : ?>
                                                <form action="<?= base_url('user/profile/changePassword'); ?>" method="post">

                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" name="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Retype Password</label>
                                                        <input type="password" class="form-control" name="retype_password">
                                                    </div>

                                                    <div class="d-flex justify-items-end">
                                                        <button type="submit" class="btn btn-primary">save</button>
                                                    </div>
                                                </form>
                                            <?php else : ?>
                                                <form action="<?= base_url('user/profile/changePassword'); ?>" method="post">

                                                    <div class="form-group">
                                                        <label>Current Password</label>
                                                        <input type="password" class="form-control" name="current_password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" name="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Retype Password</label>
                                                        <input type="password" class="form-control" name="retype_password">
                                                    </div>


                                                    <button type="submit" class="btn btn-primary">save</button>

                                                </form>
                                            <?php endif; ?>
                                        </div>
                                        <!-- end tab change password -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->