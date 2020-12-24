<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/function/dbconnect.php';
	require_once $_SERVER['DOCUMENT_ROOT']."/function/define.php";
?>

<?php
	$id_sp = $mysqli -> real_escape_string($_POST['aid_sp']);
	$soluong = $mysqli -> real_escape_string($_POST['asoluong']);
	$stt_ban = $mysqli -> real_escape_string($_POST['astt_ban']);

	$caulenh = "SELECT * FROM sanpham WHERE id_sp = {$id_sp}";
	$truyvan = $mysqli->query($caulenh);

	$arSp = mysqli_fetch_assoc($truyvan);

	$giatien = $arSp['giatien'];
	
	$sqlCheckChonMon = "SELECT * FROM chonmon WHERE id_sp = {$id_sp} AND stt_ban = {$stt_ban}";
	$resultCheckChonMon = $mysqli->query($sqlCheckChonMon);
	$arCheckChonMon = mysqli_fetch_assoc($resultCheckChonMon);
	
		if(($arCheckChonMon && count($arCheckChonMon)) == 0){

	$sql = "INSERT INTO chonmon(id_sp, soluong, stt_ban, gia) VALUES ('{$id_sp}', '{$soluong}', '{$stt_ban}', '{$giatien}')";
	$result = $mysqli -> query($sql);
	}else{
		$soluong += $arCheckChonMon['soluong'];
		$sql = "UPDATE chonmon SET soluong = {$soluong} WHERE stt_ban = {$stt_ban} AND id_sp = {$id_sp}";
	$result = $mysqli -> query($sql);
	}
	
	//Nếu đã có
 ?>

<?php  
	$sqlup = "UPDATE ban SET trangthai = 1 WHERE stt = {$stt_ban}";
	$truyvansua = $mysqli->query($sqlup);
?>

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