<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<?php include 'controller/updatesan.php'; ?>

<body id="page-top">
    <div id="wrapper">
        <?php include 'slidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'header.php'; ?>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <?php if ($masan == 0) { ?>
                                    <h1 class="h4 text-gray-900 mb-4">Thêm sân vận động</h1>
                                <?php } else { ?>
                                    <h1 class="h4 text-gray-900 mb-4">Chỉnh sửa sân vận động</h1>
                                <?php } ?>
                            </div>
                            <form class="user" action="updatesan.php" method="POST">
                                <div class="form-group">
                                    <label for="TenSan">Tên sân</label>
                                    <input type="text" name="TenSan" id="TenSan" class="form-control" placeholder="Tên sân vận động" value="<?php echo $arrInfoSan['TenSan'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="DiaChi">Địa Chỉ</label>
                                    <input type="text" name="DiaChi" id="DiaChi" class="form-control" placeholder="Địa Chỉ" value="<?php echo $arrInfoSan['DiaChi'] ?>">
                                </div>



                                <input type="hidden" name="MaSan" value="<?php echo $masan ?>">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <?php if ($masan == 0) { ?>
                                        Thêm Sân Vận Động
                                    <?php } else { ?>
                                        Hoàn tất chỉnh sửa
                                    <?php } ?>
                                </button>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>