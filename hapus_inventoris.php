<?php
include "koneksi.php";
$id = $_POST['id'];
mysqli_query($koneksi,"DELETE FROM tbl_inventoris WHERE id='$id'");
if(mysqli_affected_rows($koneksi)>0){
		$data=array(
			'status'=>true,
			'msg'=>'Berhasil dihapus...'
		);
}else{
	$data=array(
		'status'=>false,
		'msg'=>'Kesalahan...'
	);
}

echo json_encode($data);

?>