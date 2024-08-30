<?php
require('config/config.php');
date_default_timezone_set('America/Mexico_City');
$conn = db();

$est = $_GET['est'];
$kpi = $_GET['kpi'];

$date= new DateTime(); 
$date->modify('-1 hours');
$date =  $date->format('Y-m-d H:i:s');

$sql = "SELECT * FROM data WHERE fecha >= '$date' AND est='$est'" ;
$result = $conn->query($sql);
$dataPoints = array();
$data_tmp = array();
$data_hum = array();
$data_pcp = array();
$data_ins = array();
$data_win = array();
$data_wind = array();
$data_ph = array();
$data_sdt = array();
$data_tbd = array();
$data_pat = array();
while ($row = $result->fetch_assoc())  
	{
	    $data_tmp[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['tmp']);
	    $data_hum[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['hum']);
        $data_pcp[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['pcp']);
        $data_ins[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['ins']);
		$data_pat[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['pat']);
        $data_win[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['win']);
        $data_wind[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['wind']);
        $data_ph[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['ph']);
        $data_sdt[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['sdt']);
        $data_tbd[]  =  array("x" => (strtotime($row['fecha'])*1000), "y" => $row['tbd']);
	}

	
$result->free();

if ($kpi == 'tmp') {
	echo json_encode($data_tmp, JSON_NUMERIC_CHECK);
}else if ($kpi == 'hum'){
	echo json_encode($data_hum, JSON_NUMERIC_CHECK);
}else if ($kpi == 'pcp'){
	echo json_encode($data_pcp, JSON_NUMERIC_CHECK);
}else if ($kpi == 'ins'){
	echo json_encode($data_ins, JSON_NUMERIC_CHECK);
}else if ($kpi == 'pat'){
	echo json_encode($data_pat, JSON_NUMERIC_CHECK);
}else if ($kpi == 'win'){
	echo json_encode($data_win, JSON_NUMERIC_CHECK);
}else if ($kpi == 'wind'){
	echo json_encode($data_wind, JSON_NUMERIC_CHECK);
}else if ($kpi == 'ph'){
	echo json_encode($data_ph, JSON_NUMERIC_CHECK);
}else if ($kpi == 'sdt'){
	echo json_encode($data_sdt, JSON_NUMERIC_CHECK);
}else {
	echo json_encode($data_tbd, JSON_NUMERIC_CHECK);
}

?>