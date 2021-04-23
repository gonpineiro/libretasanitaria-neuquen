<?php

class SolicitudController
{
    /* Guarda un solicitud */
    public function store($res)
    {
        $solicitud = new Solicitud();
        $values = array_values($res);
        $solicitud->set(...$values);
        return $solicitud->save();
    }

    /* Busca todos los solicitud */
    public static function index($param = [], $ops = [])
    {
        return Solicitud::list($param, $ops);
    }

    /* Busca un solicitud */
    public static function get($id)
    {
        return Solicitud::get($id);
    }

    /* Actualiza un solicitud */
    public static function update($res, $id)
    {
        return Solicitud::update($res, $id);
    }

    /* Obtiene listado de solicitudes vinculado con el resto de las tablas, where estado */
    public function getSolicitudesWhereEstado($estado)
    {
        $where = "WHERE sol.estado = '$estado'";
        $conn = new BaseDatos();
        $array = [];
        $query =  $conn->query($this->insertSqlQuery($where));
        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Obtener una solicitud';
            $log = new Log();
            $log->set(null, null, null, $error, get_class(), 'getSolicitudesWhereEstado');
            $log->save();
        }
        while ($row = odbc_fetch_array($query)) array_push($array, $row);
        return $array;
    }
    /* Obtiene listado de solicitudes vinculado con el resto de las tablas, where periodo de fechas */
    public function getSolicitudesWherePeriod($fecha_desde, $fecha_hasta)
    {
        $where = "where (estado = 'Rechazado' or estado ='Aprobado') and (fecha_evaluacion BETWEEN " . "'" . $fecha_desde . "'" . " AND " . "'" . $fecha_hasta . "'" . ")";
        $conn = new BaseDatos();
        $array = [];
        $query =  $conn->query($this->insertSqlQuery($where));
        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Obtener una solicitud';
            $log = new Log();
            $log->set(null, null, null, $error, get_class(), 'getSolicitudesWherePeriod');
            $log->save();
        }
        while ($row = odbc_fetch_array($query)) array_push($array, $row);
        return $array;
    }
    /* Obtiene listado de solicitudes vinculado con el resto de las tablas, where id */
    public function getSolicitudesWhereId($id)
    {
        $where = "WHERE sol.id = '$id'";

        $conn = new BaseDatos();
        $query =  $conn->query($this->insertSqlQuery($where));

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Obtener una solicitud';
            $log = new Log();
            $log->set(null,  $id, null, $error, get_class(), 'getSolicitudesWhereId');
            $log->save();
        }

        return odbc_fetch_array($query);
    }

    private function insertSqlQuery($where)
    {
        $sql =
            "SELECT
            sol.id as id,
            wap_te.Documento as dni_te,
            wap_te.Genero as genero_te,
            wap_te.nombre as nombre_te,
            wap_te.Celular as telefono_te,
            wap_te.CorreoElectronico as email_te,
            wap_te.DomicilioReal as direccion_te,
            wap_te.FechaNacimiento as fecha_nac_te,
            wap_do.Documento as dni_do,
            wap_do.Genero as genero_do,
            wap_do.nombre as nombre_do,
            wap_do.Celular as telefono_do,
            wap_do.CorreoElectronico as email_do,
            wap_do.DomicilioReal as direccion_do,
            wap_do.FechaNacimiento as fecha_nac_do,
            cap.nombre as nombre_capacitador,
            cap.apellido as apellido_capacitador,
            cap.matricula as matricula,
            cap.lugar_capacitacion as lugar_capacitacion,
            cap.municipalidad_nqn as municipalidad_nqn,
            cap.fecha_capacitacion as fecha_capacitacion,
            cap.fecha_alta as fecha_alta_capacitacion,
            cap.path_certificado as path_certificado,
            sol.tipo_empleo as tipo_empleo,
            sol.renovacion as renovacion,
            sol.nro_recibo as nro_recibo,
            sol.estado as estado,
            sol.retiro_en as retiro_en,
            sol.fecha_evaluacion as fecha_evaluacion,
            sol.fecha_vencimiento as fecha_vencimiento,
            sol.observaciones as observaciones,
            sol.fecha_alta as fecha_alta_sol,
            sol.path_comprobante_pago as path_comprobante_pago
            FROM " . SOLICITUDES . " sol
            LEFT OUTER JOIN (
                dbo.wappersonas as wap_te
                left join " . USUARIOS . " usu_te ON wap_te.ReferenciaID = usu_te.id_wappersonas
            ) ON sol.id_usuario_solicitante = usu_te.id
            LEFT OUTER JOIN (
                dbo.wappersonas as wap_do
                left join " . USUARIOS . " usu_do ON wap_do.ReferenciaID = usu_do.id_wappersonas
            ) ON sol.id_usuario_solicitado = usu_do.id
            LEFT JOIN " . CAPACITADORES . " cap ON sol.id_capacitador = cap.id
            $where";

        return $sql;
    }
}
