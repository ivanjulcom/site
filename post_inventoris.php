<?php
include "koneksi.php";
$id=$_POST['id'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi=$_POST['deskripsi'];
$data=[];
if ($id!="") {
	$update=mysqli_query($koneksi,"UPDATE tbl_inventoris SET nama='$nama', harga='$harga', deskripsi='$deskripsi' WHERE id='$id'");
	if($update){
			$data=array(
				'status'=>true,
				'msg'=>'Berhasil diubah...'
			);
	}else{
		$data=array(
			'status'=>false,
			'msg'=>'Kesalahan...'
		);
	}
	
}else{
	mysqli_query($koneksi,"INSERT INTO tbl_inventoris (nama,harga,deskripsi)VALUES('$nama','$harga','$deskripsi')");
	if(mysqli_affected_rows($koneksi)>0){
			$data=array(
				'status'=>true,
				'msg'=>'Berhasil disimpan...'
			);
	}else{
		$data=array(
			'status'=>false,
			'msg'=>'Kesalahan...'
		);
	}
}
echo json_encode($data);
?>