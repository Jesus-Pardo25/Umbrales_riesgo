<?php
    require('config/config.php');

    $d1 = $_POST['d1'];
    $d2 = $_POST['d2'];
    $est = $_POST['est'];

    $conn = db();

    if ($est <= 0) {
        $sql = "SELECT * FROM data WHERE fecha BETWEEN '$d1' AND '$d2'"; // DEFINIMOS LA CONSULTA SQL
    }else{
        $sql = "SELECT * FROM data WHERE est = '$est' AND fecha BETWEEN '$d1' AND '$d2'"; // DEFINIMOS LA CONSULTA SQL
    }
    
    $result = $conn->query($sql); //EJECUTAMOS LA CONSULTA
    while( $rows = mysqli_fetch_assoc($result) ) {
        $records[] = $rows;
    }

    $csv_file = "saih_".date('Ymd') . ".csv"; // DEFINIMOS EL NOMBRE DEL ARCHIVO
    header("Content-Type: text/csv"); //DEFINIMOS LOS HEADERS
    header("Content-Disposition: attachment; filename=".$csv_file);
    $fh = fopen( 'php://output', 'w' ); // ABRIMOS EL DOCUMENTO TEMP
    $is_coloumn = true; // GENERARMOS UNA VARIABLE PARA SEPARAR LAS COLUMNAS
    if(!empty($records)) { //GENERAR SOLO SI HAY REGISTROS
        foreach($records as $record) { //PARA CADA ELEMENTO QUE NO SEA KEY SE GENERA LA VARIABLE RECORD DENTRO DE UN ARRAY
            if($is_coloumn) {
                fputcsv($fh, array_keys($record)); //INGRESAMOS LOS REGISTROS
                $is_coloumn = false; // CAMBIMOS LA VARIABLE DE LA COLUMNA PARA AGREGAR EN LA MISMA COLUMNA
            }
            fputcsv($fh, array_values($record)); //GENERARMOS EL DOCUMENTO
        }
        fclose($fh); //GENERAMOS EL DOCUMENTO
    }
    exit;

?>