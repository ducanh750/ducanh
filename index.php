		<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/header.php"; ?>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
							<?php 
								$dem = 0;
								$sqlSlide = "SELECT * FROM slide";
								$resultSlide = $mysqli->query($sqlSlide);
								while($arrSlide = mysqli_fetch_assoc($resultSlide)){
									$ten_sl = $arrSlide['ten_sl'];
									$hinhanh_sl = $arrSlide['hinhanh_sl'];
									$link_sl = $arrSlide['link_sl'];
									$id_sl = $arrSlide['id_sl'];
									if($dem == 0){
							?>
                            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $dem?>" class="active"></li>
							<?php
									}else{
							?>
							
                            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $dem?>"></li>
							<?php
									}
									$dem++;
								}
							?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
							<?php 
								$dem = 0;
								$sqlSlide = "SELECT * FROM slide";
								$resultSlide = $mysqli->query($sqlSlide);
								while($arrSlide = mysqli_fetch_assoc($resultSlide)){
									$ten_sl = $arrSlide['ten_sl'];
									$hinhanh_sl = $arrSlide['hinhanh_sl'];
									$link_sl = $arrSlide['link_sl'];
									$id_sl = $arrSlide['id_sl'];
									if($dem == 0){
							?>
                            <div class="item active">
                                <a href="<?php echo $link_sl; ?>" title="<?php echo $ten_sl; ?>"><img class="img-responsive img-full" src="/files/<?php echo $hinhanh_sl?>" alt="<?php echo $ten_sl?>"></a>
                            </div>
							<?php
									}else{
							?>
                            <div class="item">
                                <a href="<?php echo $link_sl; ?>" title="<?php echo $ten_sl; ?>"><img class="img-responsive img-full" src="/files/<?php echo $hinhanh_sl?>" alt="<?php echo $ten_sl?>"></a>
                            </div>
							<?php
									}
									$dem++;
								}
							?>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                    <h2 class="brand-before">
                        <small>Welcome to</small>
                    </h2>
                    <h1 class="brand-name">CAFÉ VÀ TRÀ</h1>
                    <hr class="tagline-divider">
                </div>
            </div>
        </div>

       


        

    </div>
    <!-- /.container -->
	
	<!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/footer.php"; ?>    