<?php
ini_set('display_errors', 0);
if (!isset($_SESSION))
    session_start();
$user = $_SESSION["user"];
$title = "Sản phẩm Website thương mại điện tử";
?>
<?php include "../../models/connect.php";
include "../../models/function.php"; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <?php
        echo $title;
        ?>
    </title>
    <link type="text/css" rel="stylesheet" href="../../assets/customer/css/stylessssss.css" />
    <link rel="stylesheet" href="../../assets/customer/css/footer.css">
    <link type="text/css" rel="stylesheet" href="../../assets/customer/css/home.css" />
    <link type="text/css" rel="stylesheet" href="../../assets/customer/css/menuu.css" />
    <link type="text/css" rel="stylesheet" href="../../assets/customer/css/fontawesome-free-6.5.1-web\css\all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script language="JavaScript" type="text/JavaScript" src="../../assets/customer/js/quanly.js"></script>
    <script type="text/javascript" src="../../assets/customer/js/ajax.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body onload="kt()">
    <script type="text/javascript" src="Scripts/tooltip/wz_tooltip.js"></script>
    <script type="text/javascript" src="Scripts/tooltip/tip_balloon.js"></script>
    <script type="text/javascript" src="Scripts/tooltip/tip_centerwindow.js"></script>
    <script type="text/javascript" src="Scripts/tooltip/tip_followscroll.js"></script>
    <?php include "navbar.php"; ?>
    <div id="container">
        <div id="header">
            <?php include "header.php"; ?>
        </div>

        <br clear="all" />

        <div id="main" style="margin-top:0px;">

            <div id="content">
                <?php
                $file = "content-2.php";
                if (isset($_REQUEST["b"])) {
                    $b = $_REQUEST["b"];
                    if ($b == "ct")
                        $file = "detail.php";
                    if ($b == "nsp")
                        $file = "nhomsp.php";
                    if ($b == "lsp")
                        $file = "loaisp.php";
                    if ($b == "tk")
                        $file = "result.php";
                    if ($b == "cpw")
                        $file = "change-pw.php";
                    if ($b == "showcart")
                        $file = "showcart.php";
                    if ($b == "gh")
                        $file = "giohang.php";
                    if ($b == "listcart")
                        $file = "cart.php";
                    if ($b == "m")
                        $file = "noidung-menu.php";
                    if ($b == "ttcn")
                        $file = "thongtincanhan.php";
                    if ($b == "change")
                        $file = "change.php";
                }
                include "$file";

                ?>
            </div>
        </div>
    </div>
</body>
<div id="footer" style="margin-left:0px; width:1476px">
    <footer>
        <div class="footer">
            <div class="alignFooter">
                <div class="contactInfo">
                    <div style="font-weight: bold; padding-bottom: 10px;">
                        <h3>THÔNG TIN</h3>
                    </div>
                    <ul>
                        <li class="iconOne">
                            <div class="icon"><i style="font-size: 15px;" class="fa-regular fa-clock iconAlign"></i>
                            </div>
                            <div class="textContactInfo">
                                Giờ mở cửa <br> Từ T.2-T.7: 8h30 - 20h00 (CN: 9h00 - 18h00)
                            </div>
                        </li><br>
                        <li class="iconOne">
                            <div class="icon"><i class="fa-solid fa-gear"></i><i class="fa-solid fa-wrench"></i></div>
                            <div class="textContactInfo">
                                Nhận bảo hành <br> Sau 12h - 20h00 (Trừ CN)
                            </div>
                        </li><br>
                        <li class="iconOne">
                            <div class="icon"><i style="font-size: 15px;" class="fa-regular fa-envelope iconAlign"></i>
                            </div>
                            <div class="textContactInfo">
                                Email <br> laptop@yahoo.com.vn
                            </div>
                        </li><br>
                        <li class="iconOne">
                            <div class="icon"><i style="font-size: 15px;"
                                    class="fa-solid fa-location-dot iconAlign"></i></i></div>
                            <div class="textContactInfo">
                                CN1: OOO Hà Nội <br>
                                Hotline: 098.xxxx.423
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="supportFooter">
                    <div class="supportSection">
                        <div class="introduce">
                            <div style="font-weight: bold; padding-bottom: 5px;">
                                <h3>GIỚI THIỆU</h3>
                            </div>
                            <ul>
                                <li><a href="">Về chúng tôi</a></li>
                                <li><a href="">Tiêu chí bán hàng</a></li>
                                <li><a href="">Quan điểm kinh doanh</a></li>
                                <li class="businessCooperation">Hợp tác kinh doanh</li>
                                <li><a href="">Chính sách bảo mật</a></li>
                                <li><a href="">Tuyển dụng</a></li>
                                <li><a href="">Biểu phí vận chuyển</a></li>
                            </ul>
                        </div>
                        <div class="customerSupport">
                            <div style="font-weight: bold; padding-bottom: 5px;">
                                <h3>HỖ TRỢ KHÁCH HÀNG</h3>
                            </div>
                            <ul>
                                <li><a href="">Câu hỏi thường gặp</a></li>
                                <li><a href="">Chính sách bảo hành</a></li>
                                <li><a href="">Chính sách đổi trả</a></li>
                                <li><a href="">Chính sách trả góp</a></li>
                                <li><a href="">Hướng dẫn mua online</a></li>
                                <li><a href="">Hình thức thanh toán</a></li>
                                <li><a href="">Hỗ trợ trực tuyến</a></li>
                            </ul>
                        </div>
                        <div class="customerConsulting">
                            <div style="font-weight: bold; padding-bottom: 5px;">
                                <h3>TƯ VẤN KHÁCH HÀNG</h3>
                            </div>
                            <ul>
                                <li class="iconOne">
                                    <div class="icon"><i class="fa-solid fa-phone iconAlign"></i></div>
                                    <div class="textContactInfo">
                                        <a href="">Kinh doanh 1 <br> 090xxxx029</a>
                                    </div>
                                </li>
                                <br>
                                <li class="iconOne">
                                    <div class="icon"><i class="fa-solid fa-phone iconAlign"></i></div>
                                    <div class="textContactInfo">
                                        <a href="">Kinh doanh 2 <br> 098xxxx423</a>
                                    </div>
                                </li>
                                <br>
                                <li class="iconOne">
                                    <div class="icon"><i class="fa-solid fa-phone iconAlign"></i><i
                                            class="fa-regular fa-chart-bar iconAlign"
                                            style="font-size: 10px; padding-left: 7px;"></i></div>
                                    <div class="textContactInfo">
                                        <a href="">Góp ý - Phản ánh <br> 090xxxxx26</a>
                                    </div>
                                </li>
                                <br>
                                <li class="iconOne">
                                    <div class="icon"><i class="fa-solid fa-phone iconAlign"></i><i
                                            class="fa-solid fa-gear iconAlign"
                                            style="font-size: 8px; padding-left: 5px;"></i></div>
                                    <div class="textContactInfo">
                                        <a href="">Bảo hành <br> (028) 350.xxxx3</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

</html>