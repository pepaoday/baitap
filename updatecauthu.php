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
<?php include 'controller/updatecauthu.php'; ?>

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
                                <?php if ($macauthu == 0) { ?>
                                    <h1 class="h4 text-gray-900 mb-4">Thêm Cầu Thủ</h1>
                                <?php } else { ?>
                                    <h1 class="h4 text-gray-900 mb-4">Chỉnh sửa cầu thủ</h1>
                                <?php } ?>
                            </div>
                            <form class="user" action="updatecauthu.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="TenCauThu">Tên Cầu Thủ</label>
                                    <input type="text" name="TenCauThu" id="TenCauThu" class="form-control" placeholder="Tên Cầu Thủ" value="<?php echo $arrInfoCauThu['TenCauThu'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Ngaysinh">Ngày Sinh</label>
                                    <input type="date" name="Ngaysinh" id="Ngaysinh" class="form-control" placeholder="Ngày Sinh" value="<?php echo $arrInfoCauThu['Ngaysinh'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="ViTri">Vị trí</label>
                                    <input type="text" name="ViTri" id="ViTri" class="form-control" placeholder="Vị Trí" value="<?php echo $arrInfoCauThu['ViTri'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="SoAo">Số Áo</label>
                                    <input type="number" name="SoAo" id="SoAo" class="form-control" placeholder="Số Áo" value="<?php echo $arrInfoCauThu['SoAo'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="MaDoiBong">Đội Bóng</label>
                                    <select id="MaDoiBong" class="form-control" name="MaDoiBong">
                                        <?php foreach ($arrDoiBong as $item) { ?>
                                            <option value="<?php echo $item['MaDoiBong'] ?>" <?php if ($item['MaDoiBong'] == $arrInfoCauThu['MaDoiBong']) { ?>selected <?php } ?>><?php echo $item['TenDoiBong'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="HinhAnh">Hình Ảnh</label>
                                    <input type="file" name="HinhAnh" id="HinhAnh" class="form-control">
                                </div>
                                <input type="hidden" name="MaCauThu" value="<?php echo $macauthu ?>">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <?php if ($macauthu == 0) { ?>
                                        Thêm Cầu Thủ
                                    <?php } else { ?>
                                        Hoàn tất chỉnh sửa
                                    <?php } ?>
                                </button>
                                <hr>
                            </form>
                            <?php if ($macauthu != 0) { ?>
                                <a href="infocauthu.php?macauthu=<?php echo $macauthu ?>">Xem thông tin cầu thủ</a>
                            <?php } ?>
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