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
<?php include 'controller/infocauthu.php'; ?>

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
                                <h1 class="h4 text-gray-900 mb-4">Thống kê cầu thủ <?php echo $arrInfoCauThu2['TenCauThu'] ?></h1>
                            </div>
                            <form class="user" action="infocauthu.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="SoBanThang">Số Bàn Thắng</label>
                                    <input type="number" name="SoBanThang" id="SoBanThang" class="form-control" placeholder="Số Bàn Thắng" value="<?php echo $arrInfoCauThu['SoBanThang'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="SoTheVang">Số Thẻ Vàng</label>
                                    <input type="number" name="SoTheVang" id="SoTheVang" class="form-control" placeholder="Số thẻ" value="<?php echo $arrInfoCauThu['SoTheVang'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="SoTheDo">Số Thẻ Đỏ</label>
                                    <input type="number" name="SoTheDo" id="SoTheDo" class="form-control" placeholder="Số thẻ" value="<?php echo $arrInfoCauThu['SoTheDo'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="SoTranDau">Số Trận Đấu</label>
                                    <input type="number" name="SoTranDau" id="SoTranDau" class="form-control" placeholder="Số trận" value="<?php echo $arrInfoCauThu['SoTranDau'] ?>">
                                </div>
                                <input type="hidden" name="MaCauThu" value="<?php echo $macauthu ?>">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Lưu thông tin
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