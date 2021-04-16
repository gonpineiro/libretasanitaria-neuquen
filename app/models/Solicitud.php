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
 * @property int $nro_recibo
 * @property string $path_comprobante_pago
 * @property string $estado
 * @property string $retiro_en
 * @property string $fecha_evaluacion
 * @property string $fecha_vencimiento
 * @property string $observaciones
 * @property string $id_usuario_admin
 * @property string $fecha_alta 
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
    public $fecha_alta;

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
        $this->fecha_alta = date('d/m/Y H:i:s');
    }

    public function set($id_usuario_solicitante = null, $id_usuario_solicitado = null, $tipo_empleo = null, $renovacion = null, $id_capacitador = null, $nro_recibo = null, $path_comprobante_pago = null, $estado = null, $retiro_en = null, $fecha_evaluacion = null, $fecha_vencimiento = null, $id_usuario_admin = null, $observaciones = null)
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
        $this->id_usuario_admin = $id_usuario_admin;
        $this->observaciones = $observaciones;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        return $conn->store(SOLICITUDES, $array, 'sssssssssssss');
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new BaseDatos();
        $solicitud = $conn->search(SOLICITUDES, $param, $ops);
        return $solicitud;
    }

    public static function get($id)
    {
        $conn = new BaseDatos();
        $params = ['id' => $id];
        $result = $conn->search(SOLICITUDES, $params);
        $solicitud = $conn->fetch_assoc($result);
        return $solicitud;
    }

    public static function update($res, $id)
    {
        $conn = new BaseDatos();
        $result = $conn->update(SOLICITUDES, $res, $id);
        return $result;
    }

}
