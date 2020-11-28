<?php
$waktu =$_POST["waktu"];
$jam_menit=explode(':', $waktu);
$h = $jam_menit[0];
$m = $jam_menit[1];
$result = printWords($h,$m);
echo json_encode($result);
function printWords($h, $m) 
{   if(is_numeric($h)!=1||is_numeric($m)!=1){
    	$result="invalid time";
    	$status="0";
    }else if($h>23||$m>59){
	    $result="invalid time";
	    $status="1";
	}else{
    	$h=intval($h);
	    $m=intval($m);
	    $result="";
	    $status="";
	    if($h>=12&&$h<15){
	        $waktu=" siang";
	    }else if($h>=15&&$h<=18&&$m<30){
	        $waktu=" sore";
	    }else if($h>=18&&$m>=30&&$h<=24){
	        $waktu=" malam";
	    }else{
	        $waktu=" pagi";
	    }

	    $nama_jam = array("nol", "satu", "dua", "tida", "empat", 
	                  "lima", "enam", "tujuh", "delapan", "sembilan", 
	                  "sepuluh", "sebelas", "duabelas", "tigabelas", 
	                  "empatbelas", "limabelas", "enambelas", "tujuhbelas", 
	                  "delapanbelas", "sembilanbelas", "duapuluh", "duapuluh satu", 
	                  "duapuluh dua", "duapuluh tiga", "duapuluh empat", 
	                  "duapuluh lima", "duapuluh enam", "duapuluh tujuh", 
	                  "duapuluh delapan", "duapuluh sembilan");

	 if ($m == 0){
	        $result= "Jam ".$nama_jam[$h].$waktu ;
	        $status=1;
	    }else if ($m == 1){
	        $result= $nama_jam[$h]." lewat satu menit".$waktu;
	        $status=1;
	    }else if ($m == 59){
	        $result=$nama_jam[($h % 12) + 1]." kurang semenit".$waktu;
	        $status=1;
	    }else if ($m == 15){
	        $result=$nama_jam[$h]." lewat seperempat".$waktu;
	        $status=1;
	    }else if ($m == 30){
	        $result= "Jam setengah ".$nama_jam[($h % 12) + 1].$waktu;
	        $status=1;
	    }else if ($m == 45){
	        $result= "Jam ".($nama_jam[($h % 12) + 1])." kurang seperempat".$waktu;
	        $status=1;
	    }else if ($m <= 30){
	        $result= $nama_jam[$h]." lewat ".$nama_jam[$m]." menit".$waktu;
	        $status=1;
	    }else if ($m > 30){
	        $result= $nama_jam[($h % 12) + 1]." kurang ".$nama_jam[60 - $m]." menit ".$waktu;
	        $status=1;

	    }

    }
    
    $data = array(
    'status'=>$status,
    'result'=>$result,
    ); 
  
  return $data;
 
}
?>