<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/header.php"; ?>
<?php
    $id_bv = $_GET['id_bv'];
?>
    <div class="container">

        <div class="row">
            <div class="box">

                <?php
                    $query_tt ="SELECT baiviet.*, chuyenmuc.ten_cm FROM baiviet INNER JOIN chuyenmuc ON baiviet.id_cm = chuyenmuc.id_cm WHERE baiviet.id_bv = {$id_bv}";
                    $result_tt = $mysqli->query($query_tt);

                    $arrTDM = mysqli_fetch_assoc($result_tt);
					if(count($arrTDM) == 0){
						header("location:/");exit();
					}
					$id_bv = $arrTDM["id_bv"];
					$ten_bv =$arrTDM["ten_bv"];
					$mota_bv = $arrTDM["mota_bv"];
					$hinhanh_bv =$arrTDM["hinhanh_bv"];
					$ten_cm =$arrTDM["ten_cm"];
					$chitiet_bv =$arrTDM["chitiet_bv"];
					
					// Xử lý tiếng Việt
					$nameNews = linkviet($ten_bv);
					$nameCM = linkviet($ten_cm);
					
					$url = "/chi-tiet/".$nameNews."-".$id_bv.".html";
					
					$urlCm = "/chuyen-muc/".$nameCM."-".$id_bv.".html";
                    ?>
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><?php echo $ten_bv; ?></h2>
                    <hr>
                </div>
                <div class="col-lg-12 text-justify chi-tiet-bai-viet">
                    <?php echo $chitiet_bv;?>
                    <hr>
                </div>
				<!--Chèn comment Facebook-->
                      <script>
                        window.fbAsyncInit = function() {
                        FB.init({
                          appId      : '1768827193344936',
                          xfbml      : true,
                          version    : 'v2.5'
                        });
                        };

                        (function(d, s, id){
                         var js, fjs = d.getElementsByTagName(s)[0];
                         if (d.getElementById(id)) {return;}
                         js = d.createElement(s); js.id = id;
                         js.src = "//connect.facebook.net/en_US/sdk.js";
                         fjs.parentNode.insertBefore(js, fjs);
                         }(document, 'script', 'facebook-jssdk'));
                      </script>
                      <div class="fb-comments" data-href="<?php echo URLPAGE; echo $url; ?>" data-width="100%" data-numposts="5"></div>

                
            </div>
        </div>

    </div>
    <!-- /.container -->
<script type="text/javascript">
    window.history.pushState('page2', 'Title', "<?php echo URLPAGE; echo $url; ?>");
</script>
 <?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/footer.php"; ?>       