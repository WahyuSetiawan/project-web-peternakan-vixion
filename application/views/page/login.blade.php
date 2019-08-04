<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <meta name="base_url" content="<?= base_url() ?>">

    <!-- Title Page-->
    <title>Login</title>

    <link href="<?php echo base_url("asset/css/base.css")?>" rel="stylesheet">
    <link href="<?php echo base_url("asset/css/base-login.css")?>" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="login-wrap">
            <div class="login-content">
                <div class="login-logo">
                    <a>
                        <h1>SIP</h1>
                    </a>
                </div>
                <div class="login-form">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Login Sebagai</label>
                            <select class="form-control" name="jenis">
                                <option value="karyawan">Karyawan</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input class="form-control au-input au-input--full" type="username" name="username" placeholder="Username"
                                value="">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control au-input au-input--full" type="password" name="password" placeholder="Password"
                                value="">
                        </div>
                        <div class="m-b-25"></div>
                        <?php if(isset($flashdata['login_failed'])){?>
                        <div class="col-lg-12 m-b-25">
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="color:red">
                                <strong>Gagal!</strong>
                                <?= $flashdata['login_failed']?>
                            </div>
                        </div>
                        <?php }?>
                        <button class="btn btn-success" type="submit" name="login">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Jquery JS-->
    <script src="<?php echo base_url('asset/') ?>vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo base_url('asset/') ?>vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?php echo base_url('asset/') ?>vendor/slick/slick.min.js">
    </script>
    <script src="<?php echo base_url('asset/') ?>vendor/wow/wow.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?php echo base_url('asset/') ?>vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?php echo base_url('asset/') ?>vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendor/select2/select2.min.js">
    </script>

    <script>
        var base_url = $("meta[name='base_url']").attr("content");
    </script>

    <!-- Main JS-->
    <script src="<?php echo base_url('asset/') ?>js/main.js"></script>

</body>

</html>
<!-- end document-->