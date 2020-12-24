<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/header.php"; ?>	
<?php require_once $_SERVER['DOCUMENT_ROOT']."/function/checkUser.php"; ?>
<?php
	$stt_ban = $_GET['stt'];
?>
<?php
if (isset($_POST['tinhtien'])){
	$tienban = $mysqli -> real_escape_string($_POST['tienban']);

	$sqlCheckDay = "SELECT * FROM doanhthu where ngay = CURRENT_DATE()";
	$resultCheckDay = $mysqli -> query($sqlCheckDay);
	$arCheckDay = mysqli_fetch_assoc($resultCheckDay);
	
	//echo count($arCheckDay); die();
	if(is_countable($arCheckDay)){
		if(count($arCheckDay) == 0){
			$sqlAddDay = "INSERT INTO doanhthu (ngay, tien) VALUES (CURRENT_DATE(), {$tienban})";
			$resultAddDay = $mysqli -> query($sqlAddDay);
		}else{
			$sqlSel = "SELECT * FROM doanhthu WHERE ngay = CURRENT_DATE()";
			$resultSel = $mysqli->query($sqlSel);
			$arSel = mysqli_fetch_assoc($resultSel);
	
			$tienngay = $arSel['tien'] + $tienban;
	
			$sqlAddDay = "UPDATE doanhthu SET tien = {$tienngay} WHERE ngay = CURRENT_DATE()";
			$resultAddDay = $mysqli -> query($sqlAddDay);
		}
	}
	

	

	$sqlXoa = "DELETE FROM chonmon WHERE stt_ban = {$stt_ban}";
	$resultXoa = $mysqli -> query($sqlXoa);
	
	$sqlTinhTien = "UPDATE ban SET trangthai = 0 WHERE stt = {$stt_ban}";
	$resultTinhTien = $mysqli -> query($sqlTinhTien);

	if($resultTinhTien){
		header("location:/ban.html");exit();
	} else{
		header("location:/ban.html");exit();	
	}
}
?>
<div class="container-fluid bg-grey">
	<div class="container ">
		<div class="row">
			<div class="col-md-12">
				<h2 class="margin-bottom-10">Quản lý bàn <?php echo $stt_ban; ?></h2>
				<p>(*): Không được để trống</p>
				<form action="javascript:void(0)" id="add-chon-mon" method="post" enctype="multipart/form-data" novalidate="novalidate">		
					<div class="row form-group">
					<div class="col-lg-6 form-group">
						<label class="control-label">Sản phẩm (*)</label>
						<select name="id_sp" class="form-control select2 id_spchon">
							<?php 
								$sql = "SELECT * FROM sanpham";
								$result = $mysqli -> query($sql);
								while($arCat = mysqli_fetch_assoc($result)){
									$id_sp = $arCat['id_sp'];
									$ten_sp = $arCat['ten_sp'];
									?>	
										<option value="<?php echo $id_sp; ?>">
											<?php echo $ten_sp ?>
										</option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="col-lg-3 form-group">
						<label>Số lượng (*)</label>
						<input type="text" name="soluong" class="form-control so-luong soluong" value="1">
					</div>
					<div class="col-lg-3 form-group">
						<label>Thao tác</label>
						<br />
						<input type="submit"  name="submit" value="Thêm"/>
						<input type="reset" value="Nhập lại" />
					</div>
					</div>					
				</form>
				<h3>Những sản phẩm đã gọi món</h3>
				<div class="row">
					<div class="col-md-12 table-responsive ban-table">
						<table class="table table-striped table-bordered goi-mon">
							<thead>
								<tr>
									<th class="text-center">Tên sản phẩm</th>
									<th class="text-center">Số lượng</th>
									<th class="text-center">Giá bán</th>
									<th class="text-center">Thành tiền</th>
									<th class="text-center">Chức năng</th>
								</tr>
							</thead>
							<tbody class="danh-sach-da-goi">
								
							<?php
								$sqlTD = "SELECT chonmon.*, sanpham.ten_sp FROM chonmon INNER JOIN sanpham ON chonmon.id_sp = sanpham.id_sp  WHERE stt_ban = {$stt_ban} ORDER BY id_chon DESC";
								
								$resultTD = $mysqli -> query($sqlTD);

								$tong = 0;
								while ($arTD = mysqli_fetch_assoc($resultTD)){
									$id_chon = $arTD['id_chon'];
									$ten_sp = $arTD['ten_sp'];
									$soluong = $arTD['soluong'];
									$gia = $arTD['gia'];
									$tong += $soluong * $gia;

									$urlDel = "/ban-on-del.php?id_chon={$id_chon}&stt_ban={$stt_ban}";
							?>
								<tr class="text-center">
									<td><?php echo $ten_sp; ?></td>
									<td><?php echo $soluong; ?></td>
									<td><?php echo number_format($gia); ?></td>
									<td><?php echo number_format($gia*$soluong); ?></td>
									
									<td><a href="<?php echo $urlDel;?>" onclick="return confirmAction()">Xóa</a></td>
								</tr>
							<?php
								}
							?>
							</tbody>
						</table>
						<p class="text-right" style="float: right;">Tổng tiền bàn: <span style="color: red; font-size: 25px;"><?php echo number_format($tong); ?></span></p>

						<form method="post" action="">
							<input type="hidden" name="tienban" value="<?php echo $tong;?>">
							<input type="submit" name="tinhtien" onclick="return confirmThanhToan()" value="Tính tiền bàn">	
						</form>
						<script type="text/javascript">
							function confirmThanhToan() {
							return confirm("Bạn muốn thanh toán tiền bàn này?\nTổng tiền bàn: <?php echo number_format($tong); ?>")
							}
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function confirmAction() {
	return confirm("Bạn có chắc muốn xóa?")
	}
</script> 

<script type="text/javascript">

	$(document).on('submit','#add-chon-mon', function(){
		var id_sp = $("select.id_spchon option:selected").val();
		var soluong = $("input.soluong").val();
		var stt_ban = <?php echo $stt_ban; ?>;

		$.ajax({
			url: '/ajax-them-mon.php',
			type: 'POST',
			cache: false,
			data: {
				aid_sp : id_sp,
				asoluong: soluong,
				astt_ban: stt_ban,
			},
			success: function(data){
				$('.ban-table').html(data);
			},
			error: function (){
				alert('Có lỗi xảy ra');
			}
		});		
	});

</script>

<script type="text/javascript">
	$(document).ready(function () {
		$('#add-chon-mon').validate({
			rules: {
				"soluong": {
					required: true,
					digits: true
				},
			},
			messages: {
				"soluong": {
					required: "Vui lòng nhập vào đây",
					digits: "Vui lòng nhập số nguyên dương"
				},
			}
		});
	});	
</script>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/footer.php"; ?>