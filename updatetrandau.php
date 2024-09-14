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
<?php include 'controller/updatetrandau.php'; ?>

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
                                <?php if ($matrandau == 0) { ?>
                                    <h1 class="h4 text-gray-900 mb-4">Thêm trận đấu</h1>
                                <?php } else { ?>
                                    <h1 class="h4 text-gray-900 mb-4">Chỉnh sửa trận đấu</h1>
                                <?php } ?>
                            </div>
                            <form class="user" action="updatetrandau.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="DoiNha">Đội nhà</label>
                                        <select id="DoiNha" class="form-control" name="DoiNha">
                                            <?php foreach ($arrDoiBong as $item) { ?>
                                                <option value="<?php echo $item['MaDoiBong'] ?>" <?php if ($item['MaDoiBong'] == $arrThongTinTranDau['MaDoiNha']) { ?>selected <?php } ?>><?php echo $item['TenDoiBong'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="DoiKhach">Đội khách</label>
                                        <select id="DoiKhach" class="form-control" name="DoiKhach">
                                            <?php foreach ($arrDoiBong as $item) { ?>
                                                <option value="<?php echo $item['MaDoiBong'] ?>" <?php if ($item['MaDoiBong'] == $arrThongTinTranDau['MaDoiKhach']) { ?>selected <?php } ?>><?php echo $item['TenDoiBong'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="SanDau">Sân đấu</label>
                                    <select id="SanDau" class="form-control" name="SanDau">
                                        <?php foreach ($arrSanDau as $item) { ?>
                                            <option value="<?php echo $item['MaSan'] ?>" <?php if ($item['MaSan'] == $arrThongTinTranDau['MaSan']) { ?>selected <?php } ?>><?php echo $item['TenSan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="TrongTai">Trọng Tài</label>
                                    <select id="TrongTai" class="form-control" name="TrongTai">
                                        <?php foreach ($arrTrongTai as $item) { ?>
                                            <option value="<?php echo $item['MaTrongTai'] ?>" <?php if ($item['MaTrongTai'] == $arrThongTinTranDau['MaTrongTai']) { ?>selected <?php } ?>><?php echo $item['TenTrongTai'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="VongDau">Vòng đấu</label>
                                    <select id="VongDau" class="form-control" name="VongDau">
                                        <?php foreach ($arrVongDau as $item) { ?>
                                            <option value="<?php echo $item['MaVongDau'] ?>" <?php if ($item['MaVongDau'] == $arrThongTinTranDau['MaVongDau']) { ?>selected <?php } ?>><?php echo $item['TenVongDau'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="NgayGio">Ngày giờ</label>
                                    <input type="datetime-local" id="NgayGio" class="form-control" name="NgayGio">
                                </div>
                                <div class="form-group">
                                    <label for="MoTa">Mô Tả</label>
                                    <input type="text" id="MoTa" class="form-control" name="MoTa">
                                </div>
                                <input type="hidden" name="MaTran" value="<?php echo $matrandau ?>">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <?php if ($matrandau == 0) { ?>
                                        Thêm trận đấu
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