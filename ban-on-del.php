<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/header.php"; ?>	
<?php require_once $_SERVER['DOCUMENT_ROOT']."/function/checkUser.php"; ?>
<?php
	$id_chon = $_GET['id_chon'];
	$stt_ban = $_GET['stt_ban'];
?>
<?php  
	$sql = "DELETE FROM chonmon WHERE id_chon = {$id_chon}";
	$result = $mysqli -> query($sql);
	if($result){
			header("location:/ban-on-{$stt_ban}.html");exit();
		}

?>