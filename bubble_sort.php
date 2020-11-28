<?php
$x = $_POST['x']; $y = $_POST['y'];
$x = $x + $y; 
$y = $x - $y; 
$x = $x - $y; 
 
$result= "";
if($x>$y){
	$result="Setelah diurutkan: = ".$y.", ".$x;
}else if($y>$x){
	$result="Setelah diurutkan: = ".$x.", ".$y;
}
$data = array(
	'result'=>$result,
	'msg'=>'berhasil'
);
echo json_encode($data);
?>