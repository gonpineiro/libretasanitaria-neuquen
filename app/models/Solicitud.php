<?php

/**
 * This is the model class for table "Grupo".
 *
 * @property int $id_usuario_solicitante
 * @property int $id_usuario_solicitado
 * @property string $tipo_empleo
 * @property bool $renovacion
 * @property bool $capacitacion
 * @property int $id_capacitador
 * @property string $nro_recibo
 * @property string $path_comprobante_pago
 * @property string $estado
 * @property string $retiro_en
 * @property string $fecha_evaluacion
 * @property string $fecha_vencimiento
 * @property string $observaciones
 * @property string $id_usuario_admin
 * 
 */
class Solicitud
{
    public $id_usuario_solicitante;
    public $id_usuario_solicitado;
    public $tipo_empleo;
    public $renovacion;
    public $id_capacitador;
    public $nro_recibo;
    public $path_comprobante_pago;
    public $estado;
    public $retiro_en;
    public $fecha_evaluacion;
    public $fecha_vencimiento;
    public $observaciones;
    public $id_usuario_admin;

    public function __construct()
    {
        $this->id_usuario_solicitante = "";
        $this->id_usuario_solicitado = "";
        $this->tipo_empleo = "";
        $this->renovacion = "";
        $this->id_capacitador = "";
        $this->nro_recibo = "";
        $this->path_comprobante_pago = "";
        $this->estado = "";
        $this->retiro_en = "";
        $this->fecha_evaluacion = "";
        $this->fecha_vencimiento = "";
        $this->observaciones = "";
        $this->id_usuario_admin = "";
    }

    public function set($id_usuario_solicitante = null, $id_usuario_solicitado = null, $tipo_empleo = null, $renovacion = null, $id_capacitador = null, $nro_recibo = null, $path_comprobante_pago = null, $estado = null, $retiro_en = null, $fecha_evaluacion = null, $fecha_vencimiento = null, $observaciones = null, $id_usuario_admin = null)
    {
        $this->id_usuario_solicitante = $id_usuario_solicitante;
        $this->id_usuario_solicitado = $id_usuario_solicitado;
        $this->tipo_empleo = $tipo_empleo;
        $this->renovacion = $renovacion;
        $this->id_capacitador = $id_capacitador;
        $this->nro_recibo = $nro_recibo;
        $this->path_comprobante_pago = $path_comprobante_pago;
        $this->estado = $estado;
        $this->retiro_en = $retiro_en;
        $this->fecha_evaluacion = $fecha_evaluacion;
        $this->fecha_vencimiento = $fecha_vencimiento;
        $this->observaciones = substr($observaciones, 0, LT_SOL_OBS);
        $this->id_usuario_admin = $id_usuario_admin;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        $result = $conn->store(SOLICITUDES, $array, 'sssssssssssss');

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al guardar una solicitud';
            $log = new Log();
            $log->set($this->id_usuario_solicitante, null, null, $error, get_class(), 'save');
            $log->save();
        }
        return $result;
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new BaseDatos();
        $solicitud = $conn->search(SOLICITUDES, $param, $ops);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al listar las solicitudes';
            $log = new Log();
            $log->set(null, null, null, $error, get_class(), 'list');
            $log->save();
        }
        return $solicitud;
    }

    public static function get($params)
    {
        $conn = new BaseDatos();
        $result = $conn->search(SOLICITUDES, $params);
        $solicitud = $conn->fetch_assoc($result);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a obtener la solicitud: ' . $params[0];
            $log = new Log();
            $log->set(null, null, null, $error, get_class(), 'get');
            $log->save();
        }
        return $solicitud;
    }

    public static function update($res, $id)
    {
        $conn = new BaseDatos();
        $result = $conn->update(SOLICITUDES, $res, $id);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a modificar la solicitud';
            $log = new Log();
            $log->set(null,  $id, null, $error, get_class(), 'update');
            $log->save();
        }
        return $result;
    }
}
