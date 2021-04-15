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
 * @property bool $municipalidad_nqn
 * @property int $nro_recibo
 * @property string $path_comprobante_pago
 * @property string $estado
 * @property string $retiro_en
 * @property string $fecha_emision
 * @property string $fecha_vencimiento
 * @property string $observaciones
 *
 */
class Solicitud
{
    public $id_usuario_solicitante;
    public $id_usuario_solicitado;
    public $tipo_empleo;
    public $renovacion;
    public $id_capacitador;
    public $municipalidad_nqn;
    public $nro_recibo;
    public $path_comprobante_pago;
    public $estado;
    public $retiro_en;
    public $fecha_emision;
    public $fecha_vencimiento;
    public $observaciones;

    public function __construct()
    {
        $this->id_usuario_solicitante = "";
        $this->id_usuario_solicitado = "";
        $this->tipo_empleo = "";
        $this->renovacion = "";
        $this->id_capacitador = "";
        $this->municipalidad_nqn = "";
        $this->nro_recibo = "";
        $this->path_comprobante_pago = "";
        $this->estado = "";
        $this->retiro_en = "";
        $this->fecha_emision = "";
        $this->fecha_vencimiento = "";
        $this->observaciones = "";
    }

    public function set($id_usuario_solicitante = null, $id_usuario_solicitado = null, $tipo_empleo = null, $renovacion = null, $id_capacitador = null, $municipalidad_nqn = null, $nro_recibo = null, $path_comprobante_pago = null, $estado = null, $retiro_en = null, $fecha_emision = null, $fecha_vencimiento = null, $observaciones = null)
    {
        $this->id_usuario_solicitante = $id_usuario_solicitante;
        $this->id_usuario_solicitado = $id_usuario_solicitado;
        $this->tipo_empleo = $tipo_empleo;
        $this->renovacion = $renovacion;
        $this->id_capacitador = $id_capacitador;
        $this->municipalidad_nqn = $municipalidad_nqn;
        $this->nro_recibo = $nro_recibo;
        $this->path_comprobante_pago = $path_comprobante_pago;
        $this->estado = $estado;
        $this->retiro_en = $retiro_en;
        $this->fecha_emision = $fecha_emision;
        $this->fecha_vencimiento = $fecha_vencimiento;
        $this->observaciones = $observaciones;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        $conn->store(SOLICITUDES, $array, 'sssssssssssss');
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
