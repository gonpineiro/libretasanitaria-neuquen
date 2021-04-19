<?php 

function data_submitted() {
    
    $_AAux= array();
    if (!empty($_REQUEST))
        $_AAux =$_REQUEST;
     if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
     return $_AAux;
        
}
function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}
function console_log($data) {
    echo "<script>";
    echo "console.log('$data')";
    echo "</script>";
}
function verificarSesion(){
    if (!isset($_SESSION['usuario'])) {
        header('https://weblogin.muninqn.gov.ar');
        exit();
    }
}

function cargarLog($idUsuario = null, $idSolicitud = null, $error = '-'){
    $log_controller = new LogController();
    $log_controller->alta([
        'idUsuario' =>  $idUsuario,
        'idSolicitud' => $idSolicitud,
        'error' => $error
    ]);
}

function enviarMailApi ( $address, $arrIdSolicitud ) {
    if (count($arrIdSolicitud) > 1){
        $body = "<p>Tus solicitudes ( ";
        foreach ($arrIdSolicitud as $id) {
            $body.="Nro. $id ";
        }
        $body .= ") han sido recibidas y están siendo procesadas. Dentro de las próximas 72 hs. recibirás un nuevo correo electrónico de la aprobación o no de los beneficios. </p><p>Dirección General SUBE - Subsecretaría de Transporte</p><p>Municipalidad de Neuquén</p>";

    } else {
        $idsolicitud = $arrIdSolicitud[0];
        $body = "<p>Su solicitud para Libreta Sanitaria fue recbida, de ser aceptada nos comunicaremos con usted. </p><p>Cualquier duda o consulta pod&eacute;s enviarnos un email a: <a href='mailto:carnetma@muninqn.gob.ar' target='_blank'>carnetma@muninqn.gob.ar</a></p><p>Direcci&oacute;n Municipal de Calidad Alimentaria</p><p>Municipalidad de Neuquén</p>";
    }

    $subject = "Solicitud de Libreta Sanitaria";
    $post_fields = json_encode( ['address'=>$address, 'subject' => $subject, 'htmlBody' => $body]);
    
    $uri = "https://weblogin.muninqn.gov.ar/api/Mail";
    $ch = curl_init( $uri );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_fields );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($result, true);
}

function getDireccionesParaAdjunto($adjunto, $idsolicitud, $adjuntoInputName){
    $path = null;
    
    $target_path_local = ROOT_PATH ."\\archivos\\$idsolicitud\\$adjuntoInputName\\";
    
    if (!file_exists($target_path_local)){
        mkdir($target_path_local, 0755, true);
    };

    if (!empty($adjunto)) {
        $path = $target_path_local . $adjuntoInputName;
        switch($adjunto['type']) {
            case('image/jpeg'):
                $path = $path . '.jpeg'; 
                break;
            case('image/jpg'):
                $path = $path . '.jpg'; 
                break;
            case('image/png'):
                $path = $path . '.png'; 
                break;
            case 'application/pdf':
                $path = $path . '.pdf'; 
                break;
                
        }
    };

    return $path;
}

/**
 * Chequea que el tamaño y tipo de archivos subidos sean los correctos
 * JS Alert si no lo son
 * @param int maxsize en mb del archivo, default 200mb
 * @param array formatos aceptados
 * @return bool false si hubo un error en el chequeo de archivos
*/
function checkFile( $maxsize = 15, $acceptable = array('application/pdf','image/jpeg','image/jpg','image/gif','image/png','video/mp4','video/mpeg') )
{
    if (isset($_FILES) && !empty($_FILES)) {
        $errors = array();
        
        $phpFileUploadErrors = array(
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );
        
        $maxsize_multiplied = $maxsize*1000000;

        foreach ($_FILES as $key => $value) {
            if ( ($value['size'] >= $maxsize_multiplied) && ($value['size'] != 0) ) {
                $errors[] = "$key Archivo adjunto muy grande. Debe pesar menos de $maxsize megabytes.";
            }
            if ( (!in_array($value['type'], $acceptable)) && !empty($value['type']) ) {
                $error = "$key Tipo de archivo invalido. Solamente tipos ";
                foreach ( $acceptable as $val ) {
                    $error .= $val.', ';
                }
                $error .= "se aceptan.";
                $errors[] = $error; 
            }
            if ( $value['error'] != 0 && !empty($value['type']) ) {
                $errors[] = $phpFileUploadErrors[$value['error']];
            }
        }

        if (count($errors) === 0) {
            return true;
        } else {
            foreach ($errors as $error) {
                echo '<script>alert("' . $error . '");</script>';
            }
            return false;
        }
    }
}

spl_autoload_register(function ($class_name){
    $directorys = array(
        APP_PATH.'/controllers/',
        APP_PATH.'/models/',
        CON_PATH.'/'
    );

    foreach($directorys as $directory){
        if(file_exists($directory.$class_name . '.php')){
            include($directory.$class_name . '.php');
            return;
        }
    }
});

?>