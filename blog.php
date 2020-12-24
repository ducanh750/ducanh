<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/header.php"; ?>
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Cafe Và Trà- 
                        <strong>blog</strong>
                    </h2>
                    <hr>
                </div>

                <?php
                    $query_tt ="SELECT baiviet.*, chuyenmuc.ten_cm FROM baiviet INNER JOIN chuyenmuc ON baiviet.id_cm = chuyenmuc.id_cm GROUP BY id_cm  ORDER BY id_bv DESC";
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
            </div>
        </div>

    </div>
    <!-- /.container -->

 <?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/footer.php"; ?>       