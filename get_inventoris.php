<?php
include "koneksi.php";
$query=mysqli_query($koneksi,"SELECT * FROM tbl_inventoris ORDER BY id DESC");
while ($row=mysqli_fetch_object($query)) {
	$edit='<button class="edit" data-id="'.$row->id.'" data-nama="'.$row->nama.'" data-harga="'.$row->harga.'" data-deskripsi="'.$row->deskripsi.'">Edit</button>';
	$hapus='<button class="hapus" data-id="'.$row->id.'">Hapus</button';
	$data[]= array(
		'nama'=>$row->nama,
		'harga'=>$row->harga,
		'deskripsi'=>$row->deskripsi,
		'edit'=>$edit,
		'hapus'=>$hapus
	);
}
echo json_encode($data);
?>