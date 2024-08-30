<?php
// SE UTILIZA UNA PLANTILLA GRATUITA DE BOOSTRAP CON CUSTOM CSS 
// IMPORTAMOS EL ARCHIVO DE CONFIGURACIÓN, ES DECIR, EL QUE NOS CONECTA A LA BASE DE DATOS Y DETERMINA VARIABLES GLOBALES
header('Content-Type: text/html; charset=utf_unicode_ci');
require('config/config.php');
include('functions.php');
$node_0 = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SAIH Morelia | Inicio</title>
    <link rel="icon" type="image/png" href="img/icono.png">
    <link rel="icon" type="image/png" href="img/gia.png">
    

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- My Custom style-->
    <link href="css/style.css" rel="stylesheet">

    <!-- CUSTOM UX FORM -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

</head>

<body id="page-top">
    <!-- LOAD -->
    <img class="load" src="img/loading.gif">
    <div id="conn">

        <!-- HEADER -->
        <header id="header">
        <nav class="navbar navbar-expand-lg navbar-success">
        <a href="index.php" class="logo" title="Sistema Automático de Información Hidrológica de Morelia" style="position: relative; left: 5px;">
    <img src="img/logo.png" alt="">
</a>
            <a href="index.php" class="logo" title="Sistema Atomático de Información Hidrológica de Morelia"><img src="img/gia.png" alt=""></a>
            <a class="nav-item active nav-link d-inline-block text-truncate" style="color: black; width: 250px;" id="node">Morelia<span class="sr-only">(current)</span></a>
    
    
<img src="img/in.png" alt="Descripción de la imagen" class="bottom-right-image">

<style>
.bottom-right-image {
    position: fixed;
    bottom: 10px;
    right: 5px;
    width: 700px;
    height: auto;
}
</style>




            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">


                    <li class="nav-item dropdown">
                        <select id="kpi" name="kpi" class="select"  multiple multiple data-max-options="5" data-max-options-text="Máximo 5 Indicadores" title="Indicador" aria-labelledby="nav-item dropdown">
                            <optgroup label="Meteorológicas">
                                <option value="tmp" data-subtext="°C" selected>Temperatura</option>
                                <option value="hum" data-subtext="%">Humedad</option>
                                <option value="pcp" data-subtext="mm">Preciptación</option>
                                <option value="ins" data-subtext="mm/h" selected>Intensidad</option>
                                <option value="pat" data-subtext="hPa">Presión atmosférica</option>
                                <option value="win" data-subtext="km/h">Velocidad del viento</option>
                                <option value="wind" data-subtext="°">Dirección del viento</option>

                            </optgroup>
                            <optgroup label="Ambientales">
                                <option value="ph" data-subtext="" selected>Ph de la lluvia</option>
                                <option value="sdt" data-subtext="ppm">SDT</option>
                                <option value="tbd" data-subtext="NTU">Turbidez del agua</option>
                            </optgroup>
                        </select>
                    </li>
                    <li class="nav-item">
                        <input id="d1" name="d1" class="nav-link" type="date" style="width:230px"><span class="sr-only">(current)</span></input>
                        <input id="res_node" class="ml-2"  type="number" style="display: none;" disabled>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" type="button" data-toggle="modal" data-target="#export">Exportar<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="equipo/index.php">Equipo <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="blog/index.php">Blog <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="contacto/index.php">Contacto <span class="sr-only">(current)</span></a>
                    </li>

                </ul>
            </div>
        </nav>
        </header><!-- End Header -->



        <!-- LOGO -->
        <img class="logo-i" src="img/logo.png">
       
     



        <!--ULTIMO DATO REGISTRADO -->


        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card h-100 py-2" style="width: 12rem;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h5 class="text-xs font-weight-bold text-uppercase text-dark mb-1">ÚLTIMO DATO:</h5>
                            <h6 id="fecha" class="card-subtitle mb-1 font-weight-bold text-dark mb-0"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- INDICADORES -->
        <div id="kpis">

            <div data-toggle="modal" data-target="#tmpkpi" id="info_tmp" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-primary shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Temperatura </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="tmp"><?php get_kpi($node_0, "tmp"); ?></span> °C</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-thermometer-half fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FICHA DE HUMEDAD -->
            <div data-toggle="modal" data-target="#humkpi" id="info_hum" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-primary shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Humedad</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="hum"><?php get_kpi($node_0, "hum"); ?></span> %</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tint fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FICHA DE PRECIPITACION -->
            <div data-toggle="modal" data-target="#pcpkpi" id="info_pcp" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-primary shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Precipitación</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="pcp"><?php get_kpi($node_0, "pcp"); ?></span> mm</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cloud-rain fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FICHA INTENSIDAD -->
            <div data-toggle="modal" data-target="#inskpi" id="info_ins" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-primary shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Intensidad</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="ins"><?php get_kpi($node_0, "ins"); ?></span> mm/h</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cloud-rain fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FICHA PRESIÓN ATMOSFÉRICA -->
            <div data-toggle="modal" data-target="#patkpi" id="info_pat" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-primary shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Presión atmosférica</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="pat"><?php get_kpi($node_0, "pat"); ?></span> hPa</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cloud fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FICHA VELOCIDAD DEL VIENTO -->
            <div data-toggle="modal" data-target="#winkpi" id="info_win" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-primary shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Velocidad del viento</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="win"><?php get_kpi($node_0, "win"); ?></span> km/h</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wind fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- FICHA DIRECCION DEL VIENTO -->
            <div data-toggle="modal" data-target="#windkpi" id="info_wind" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-primary shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Dirección del viento</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="wind"><?php get_kpi($node_0, "wind"); ?></span> °</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wind fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- FICHA PH DEL AGUA -->
            <div data-toggle="modal" data-target="#phkpi" id="info_ph" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-success shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    PH de la lluvia</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="ph"><?php get_kpi($node_0, "ph"); ?></span></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-vial fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FICHA SOLIDOS DISUELTOS TOTALES -->
            <div data-toggle="modal" data-target="#sdtkpi" id="info_sdt" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-success shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    SDT</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sdt"><?php get_kpi($node_0, "sdt"); ?></span> ppm</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-vial fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FICHA TURBIDEZ DEL AGUA -->
            <div data-toggle="modal" data-target="#tbdkpi" id="info_tbd" class="col-xl-2 col-md-6 mb-4 kpi" style="width: 12rem;">
                <div class="card border-left-success shadow h-100 py-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Turbidez del agua</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="tbd"><?php get_kpi($node_0, "tbd"); ?></span> NTU</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-vial fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <!-- FIN ELEMENTO INCRUSTADO -->
    <!-- MAPA -->
    <div id="map"></div>

    <!-- EXPORTAR DATOS -->
    <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="export.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Exportar datos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona un rango de fechas para realizar la exportación en CSV.</div>
                <span class="ml-2">Fecha inicial: </span>
                <input name="d1" class="ml-2" type="date" style="width:230px">
                <span class="ml-2">Fecha final: </span>
                <input name="d2" class="ml-2" type="date" style="width:230px">
                <span class="ml-2">Estación</span>
                <select name="est" class="form-select ml-2" aria-label="Default select example">
                    <option selected>Estación</option>
                    <option value="0">Todos</option>
                    <option value="1">Ciudad Universitaria</option>
                    <option value="2">Lomas de las Ámericas Sur</option>
                    <option value="3">Ventura Puente</option>
                    <option value="4">Primo Tapia</option>
                    <option value="5">Rincón Ocolucen</option>
                    <option value="6">Arcoiris</option>
                    <option value="7">Gertrudiz Sánchez</option>
                    <option value="8">Tinijaro</option>
                    <option value="9">CU LoRa</option>
                    <option value="10">Lancaster</option>
                    <option value="11">CRIT</option>
                    <option value="12">San José del Cerrito</option>
                    <option value="13">Chapultepec Oriente</option>
                    <option value="14">Cuauhtémoc</option>
                    <option value="15">Obrera</option>
                    <option value="16">Frac. Lazaro Cardenas</option>
                    <option value="17">El Porvenir</option>
                    <option value="18">Jardines de Guadalupe</option>
                    <option value="19">Agustín Arriaga Rivera</option>
                    <option value="20">Reforma</option>
                    <option value="21">Los Manantiales</option>
                    <option value="22">Santa María</option>
                    <option value="23">Ejidal Isaac Arriaga</option>
                    <option value="24">Los Ángeles</option>
                    <option value="25">Torreón Nuevo</option>
                    <option value="26">Mayo</option>
                    <option value="27">Indeco la Huerta</option>
                     
                </select>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <input class="btn btn-primary" type="submit" value="CSV">
                </div>
            </form>
        </div>
    </div>

    <!--TEMP KPI Modal-->
    <div class="modal fade" id="tmpkpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Temperatura en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-tmp" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>

    <!--HUM KPI Modal-->
    <div class="modal fade" id="humkpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Humedad en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-hum" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>

    <!--PCP KPI Modal-->
    <div class="modal fade" id="pcpkpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Precipitación en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-pcp" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>

    <!--INS KPI Modal-->
    <div class="modal fade" id="inskpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Intensidad de precipitación en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-ins" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>
    <!--PAT KPI Modal-->
    <div class="modal fade" id="patkpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Presión atmosférica en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-pat" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>

    <!--WIN KPI Modal-->
    <div class="modal fade" id="winkpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Velocidad del viento en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-win" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>

    <!--WIND KPI Modal-->
    <div class="modal fade" id="windkpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dirección del viento en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-wind" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>

    <!--PH KPI Modal-->
    <div class="modal fade" id="phkpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">pH de la lluvia en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-ph" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>


    <!--SDT KPI Modal-->
    <div class="modal fade" id="sdtkpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SDT en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-sdt" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>

    <!--TBD KPI Modal-->
    <div class="modal fade" id="tbdkpi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Turbidez en tiempo real</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartContainer-tbd" style="width: 100%; height: 375px;"></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="button" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- GOOGLE MAPS API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYWglNL6JQImeRoUiJB4E9GGi7dK3JCZc&callback=initMap"> </script>
    <!-- CODIGO CHINGON -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>