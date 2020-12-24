<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/header.php"; ?>	
<?php require_once $_SERVER['DOCUMENT_ROOT']."/function/checkUser.php"; ?>

<div class="container bg-grey">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-uppercase" style="text-align: center; padding-bottom: 10px;">Quản lý bàn</h2>
			<hr>

			<?php  
				if(isset($_POST['chuyenban'])){
					$id_bancu = $mysqli -> real_escape_string($_POST['id_bancu']);
					$id_banmoi = $mysqli -> real_escape_string($_POST['id_banmoi']);

					//Đổi trạng thái bàn cũ = 0
					$sqlDoiTrangThaiCu = "UPDATE ban SET trangthai = 0 WHERE stt = {$id_bancu}";
					$resultDoiTrangThaiCu = $mysqli->query($sqlDoiTrangThaiCu);

					//Đổi trạng thái bàn mới = 1
					$sqlDoiTrangThaiMoi = "UPDATE ban SET trangthai = 1 WHERE stt = {$id_banmoi}";
					$resultDoiTrangThaiMoi = $mysqli->query($sqlDoiTrangThaiMoi);

					//Đổi chọn món
					$sqlDoiChonMon = "UPDATE chonmon SET stt_ban = {$id_banmoi} WHERE stt_ban = {$id_bancu}";
					$resultDoiChonMon = $mysqli->query($sqlDoiChonMon);

					if($resultDoiTrangThaiCu && $resultDoiTrangThaiMoi && $resultDoiChonMon){
						header("location:/ban.html?msg=Đã thay đổi");exit();
					}
				}

			?>

			<form role="form" method="post">
				<div class="row">
					<div class="form-group col-lg-4 col-lg-offset-1">
						<label>Bàn cũ</label>
						<select name="id_bancu" class="form-control select2 id_spchon">
							<?php  
								for ($i=1; $i < 31; $i++) { 
							?>
							<option value="<?php echo $i; ?>">Bàn số <?php echo $i; ?></option>
							<?php		
								}
							?>
						</select>
					</div>
					<div class="form-group col-lg-4">
						<label>Gộp vào bàn</label>
						<select name="id_banmoi" class="form-control select2 id_spchon">
							<?php  
								for ($i=1; $i < 31; $i++) { 
							?>
							<option value="<?php echo $i; ?>">Bàn số <?php echo $i; ?></option>
							<?php		
								}
							?>
						</select>
					</div>
					<div class="form-group col-lg-2 submit-chuyen">
						<label>Thao tác</label>
						<br />
						<button type="submit" class="btn btn-default" name="chuyenban">Chấp nhận</button>
					</div>
				</div>	
			</form>
			<div class="row text-center">
				<?php  
					$sql = "SELECT * FROM ban";
					$result = $mysqli -> query($sql);
					while ($arBan = mysqli_fetch_assoc($result)){
						$stt = $arBan['stt'];
						$trangthai = $arBan['trangthai'];
						if($stt < 10){
							$stt10 = '0'.$stt;
						}else{
							$stt10 = $stt;
						}
						if ($trangthai == 1) {
				?>
				<div class="col-xs-6 col-sm-3 col-md-2 ban">
					<a href="ban-on-<?php echo $stt; ?>.html" class="ban-khong-trong"><?php echo $stt10;?></a>
				</div>
				<?php
						}else{
				?>
				<div class="col-xs-6 col-sm-3 col-md-2 ban">
					<a href="ban-on-<?php echo $stt; ?>.html" class="ban-trong"><?php echo $stt10;?></a>
				</div>
				<?php 
						}
					}
				?>
			</div>
		</div>
	</div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/footer.php"; ?>