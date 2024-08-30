<?php

// OBTENER DATOS DE LA DB, LE PASAMOS EL PARAMETRO VAL PARA ARROJAR UN DATO EN ESPECIFICO
// traemos todo lo que no sea 0 ya que se trata de errores
function get_data($est, $date)
{
    $conn = db();
    if ($date != "") {
        if ($est < 1) {
            $sql = "SELECT id, est, fecha, AVG(tmp), AVG(hum), AVG(pcp), AVG(win), AVG(wind), AVG(ins), AVG(pat), AVG(ph), AVG(sdt), AVG(tbd) FROM status "; // DEFINIMOS LA CONSULTA SQL PARA 
        } else {
            $sql = "SELECT * FROM data WHERE est = '$est' and fecha <= '$date' ORDER BY id DESC"; // DEFINIMOS LA CONSULTA SQL
        }
    } else {
        if ($est < 1) {
            $sql = "SELECT id, est, fecha, AVG(tmp), AVG(hum), AVG(pcp), AVG(win), AVG(wind), AVG(ins), AVG(pat), AVG(ph), AVG(sdt), AVG(tbd) FROM status"; // DEFINIMOS LA CONSULTA SQL PARA 
        } else {
            $sql = "SELECT * FROM data WHERE est = '$est' ORDER BY id DESC "; // DEFINIMOS LA CONSULTA SQL
        }
    }

    $result = $conn->query($sql); //EJECUTAMOS LA CONSULTA

    if ($result->num_rows > 0) { // SI HAY DATOS
        $row = $result->fetch_assoc(); // TRAEMOS LOS DATOS COMO UN ARRAY ASOCIATIVO
        echo json_encode($row);
    } else {
        echo json_encode(0);
    }
}

// FUNCIÓN PARA OBTENER EL VALOR DE UN INDICADOR ESPECIFICO

function get_kpi($est, $val)
{
    $conn = db();
    $sql = "SELECT * FROM data WHERE est = '$est'"; // DEFINIMOS LA CONSULTA SQL  
    $result = $conn->query($sql); //EJECUTAMOS LA CONSULTA
    if ($result->num_rows > 0) { // SI HAY DATOS
        $row = $result->fetch_assoc(); // TRAEMOS LOS DATOS COMO UN ARRAY ASOCIATIVO
        echo $row[$val] . " ";
    } else {
        echo "Sin datos";
    }
}

// FUNCIÓN PARA OBTENER EL STRING DE LA UNIDAD DE MEDIDA

function get_udm($short)
{
    $conn = db();
    $sql = "SELECT * FROM udm WHERE short_name ='$short'"; // DEFINIMOS LA CONSULTA SQL
    $result = $conn->query($sql); //EJECUTAMOS LA CONSULTA
    if ($result->num_rows > 0) { // SI HAY DATOS
        $row = $result->fetch_assoc(); // TRAEMOS LOS DATOS COMO UN ARRAY ASOCIATIVO
        echo " " . $row['udm'];
    }
}
