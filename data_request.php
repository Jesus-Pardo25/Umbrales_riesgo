<?php
require('config/config.php');
include('functions.php');
// OBTENER DATOS DE LA DB, LE PASAMOS EL PARAMETRO VAL PARA ARROJAR UN DATO EN ESPECIFICO
$node = $_POST['node'];
$date = $_POST['date'];

get_data($node,$date);

?>