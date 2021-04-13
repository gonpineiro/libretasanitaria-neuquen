<?php
include '../../../app/config/config.php';

if (isset($_SESSION['userProfiles']) && $_SESSION['userProfiles'] != 3){
    header('Location: https://weblogin.muninqn.gov.ar');
    exit();
}
   
$nombreapellido = explode(",", $_SESSION['usuario']["razonSocial"]);
$nombre = $nombreapellido[1];
$apellido = $nombreapellido[0];
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/menu/menu.css">
</head>

<body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <tbody>
	        <tr>
	            <td style="padding: 35px;">
		            <div class="header">
	                	<img  class="logo" alt="" src="../../estilos/menu/webLoginLogoReduced.png" style="display: inline-block; width: max-content; max-width: 80%;">
	                	<div onclick="pago()" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.1)'" onmouseleave="this.style.backgroundColor='transparent'" style="cursor: pointer; color: rgb(16, 154, 214); font-size: 8pt; display: inline-block; padding: 10px; border-radius: 10px; background-color: transparent;">contacto: soporte@muninqn.gov.ar</div>
	                	<div id="divUserInfo" style="display: table-cell;">
	                		<table id="tableWidth" style="float: right; margin-right: 30px;">
								<tbody>
									<tr onclick="usrOptions.style.display='block'" onmouseleave="usrOptions.style.display='none'" style="cursor: pointer;">
										<td>
											<img alt="" style="width: 25px;" src="../../estilos/menu/icono-login.png">
		                    			</td>
										<td style="display: inline-flex; padding: 5px;">
                                            <div style="color: #109AD6;" id="lblVarUSUARIO"><?php echo "$apellido $nombre"; ?></div>
		                    			</td>
										<td>
											<img alt="" src="../../estilos/menu/arrDown.jpg">
		                    			</td>
	                				</tr>
					                <tr>
					                    <td colspan="3">
					                        <div onmouseover="this.style.display='block'" onmouseleave="this.style.display='none'" id="usrOptions" style="z-index: 999; background-color: transparent; display: none; position: absolute; margin-top: -10px; width: 307px;">
						                        <div onclick="window.location.href = 'https://weblogin.muninqn.gov.ar'" class="whiteButton" style="margin-top: 5px;">Regresar</div>
						                    </div>
					                    </td>
					                </tr>
	                			</tbody>
	            			</table>
	                	</div>
	                </div>
				</td>
        	</tr>
		</tbody>

    <div class="container">
        <div class="form-group">
            <div class="form-group col-12">
                <div class='col-sm d-flex justify-content-center'>
                    <button type="button"  onclick='window.location.replace("./descarga-csv.php?descargar=1")' class="btn btn-primary btn-lg" style="background-color: #109AD6;">CSV Emprende</button>
                </div>
            </div>
            <div class="form-group col-12">
                <div class='col-sm d-flex justify-content-center'>
                    <button type="button"  onclick='window.location.replace("./descarga-csv.php?descargar=2")' class="btn btn-primary btn-lg" style="background-color: #109AD6;">CSV Raiz</button>
                </div>
            </div>
            <div class="form-group col-12">
                <div class='col-sm d-flex justify-content-center'>
                    <button type="button"  onclick='window.location.replace("./descarga-csv.php?descargar=3")' class="btn btn-primary btn-lg" style="background-color: #109AD6;">CSV Todos</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="" async defer></script>
</body>

</html>