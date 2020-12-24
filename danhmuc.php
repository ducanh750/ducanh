<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/header.php"; ?>
<?php
    $id_cm = $_GET['id_cm'];
    $queryTSD = "SELECT count(*) AS tongsodong FROM baiviet WHERE id_cm = {$id_cm}";
    $resultTSD = $mysqli -> query ($queryTSD);
    $arTSD = mysqli_fetch_assoc($resultTSD);
    $tongsodong = $arTSD['tongsodong'];
    //số dòng trên 1 trang
    $row_count = TRANGPUBLIC;
    //tổng số trang
    $sotrang = ceil($tongsodong/$row_count);
    
    //lấy trang hiện tại
    if (isset ($_GET['page'])){
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }
    $offset = ($current_page - 1) * $row_count;
    //kết thúc phân trang
    
?>
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Cafe Không tên - 
                        <strong>blog</strong>
                    </h2>
                    <hr>
                </div>

                <?php
                    $query_tt ="SELECT baiviet.*, chuyenmuc.ten_cm FROM baiviet INNER JOIN chuyenmuc ON baiviet.id_cm = chuyenmuc.id_cm WHERE baiviet.id_cm = {$id_cm} ORDER BY id_bv DESC LIMIT {$offset}, {$row_count}";
                    $result_tt = $mysqli->query($query_tt);
                    $row_cat= array();
                    while($arrTDM = mysqli_fetch_assoc($result_tt)){
                        $id_bv = $arrTDM["id_bv"];
                        $ten_bv =$arrTDM["ten_bv"];
                        $mota_bv = $arrTDM["mota_bv"];
                        $hinhanh_bv =$arrTDM["hinhanh_bv"];
                        $ten_cm =$arrTDM["ten_cm"];
                        $id_cm =$arrTDM["id_cm"];
                        
                        // Xử lý tiếng Việt
                        $nameNews = linkviet($ten_bv);
                        $nameCM = linkviet($ten_cm);
                        
                        $url = "/chi-tiet/".$nameNews."-".$id_bv.".html";
                        $urlCm = "/chuyen-muc/".$nameCM."-".$id_cm.".html";
                    ?>
                <div class="col-lg-12 text-center">
                    <a href="<?php echo $url; ?>">
                        <img class="img-responsive img-border img-full" src="/files/<?php echo $hinhanh_bv; ?>" alt="">
                    </a>    
                    <h2>
                        <br>
                        <small><a href="<?php echo $url; ?>"><?php echo $ten_bv; ?></a></small>
                    </h2>
                    <p></p>
                    <a href="<?php echo $urlCm; ?>" class="btn btn-default btn-lg"><?php echo $ten_cm;?></a>
                    <hr>
                </div>
                <?php  
                    }
                ?>
                
                <div class="col-lg-12 text-center">
                    <ul class="pager">
                        <?php
                    for ($i = 1; $i <= $sotrang; $i++){
                        if ($i == $current_page) {
                            ?>
                        <li class="active"><a><?php echo $i; ?></a></li>
                        <?php 
                        } else {
                                $urlpage = "";
                            ?>
                                <li class=""><a href="<?php echo $urlCm; ?>/page<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php 
                        }
                    }
                ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

 <?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/footer.php"; ?>       