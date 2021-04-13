<?php

namespace App\Models;

use App\Connections\ConnectMysql;

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
 * @property string $fecha_alta
 *
 */
class Solicitud
{
    public $id_usuario_solicitante;
    public $id_usuario_solicitado;
    public $tipo_empleo;
    public $renovacion;
    public $capacitacion;
    public $id_capacitador;
    public $municipalidad_nqn;
    public $nro_recibo;
    public $path_comprobante_pago;
    public $estado;
    public $retiro_en;
    public $fecha_alta;

    public function __construct()
    {
        $this->id_usuario_solicitante = "";
        $this->id_usuario_solicitado = "";
        $this->tipo_empleo = "";
        $this->renovacion = "";
        $this->capacitacion = "";
        $this->id_capacitador = "";
        $this->municipalidad_nqn = "";
        $this->nro_recibo = "";
        $this->path_comprobante_pago = "";
        $this->estado = "";
        $this->retiro_en = "";
        $this->fecha_alta = "";
    }

    public function set($id_usuario_solicitante = null, $id_usuario_solicitado = null, $tipo_empleo = null, $renovacion = null, $capacitacion = null, $id_capacitador = null, $municipalidad_nqn = null, $nro_recibo = null, $path_comprobante_pago = null, $estado = null, $retiro_en = null, $fecha_alta = null)
    {
        $this->id_usuario_solicitante = $id_usuario_solicitante;
        $this->id_usuario_solicitado = $id_usuario_solicitado;
        $this->tipo_empleo = $tipo_empleo;
        $this->renovacion = $renovacion;
        $this->capacitacion = $capacitacion;
        $this->id_capacitador = $id_capacitador;
        $this->municipalidad_nqn = $municipalidad_nqn;
        $this->nro_recibo = $nro_recibo;
        $this->path_comprobante_pago = $path_comprobante_pago;
        $this->estado = $estado;
        $this->retiro_en = $retiro_en;
        $this->fecha_alta = $fecha_alta;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new ConnectMysql();
        $conn->store('ls_solicitudes', $array, 'ssssssssssss');
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new ConnectMysql();
        $solicitud = $conn->search('ls_solicitudes', $param, $ops);
        return $solicitud;
    }

    public static function get($id)
    {
        $conn = new ConnectMysql();
        $params = ['id' => $id];
        $result = $conn->search('ls_solicitudes', $params);
        $solicitud = $conn->fetch_assoc($result);
        return $solicitud;
    }

    public static function update($res, $id)
    {
        $conn = new ConnectMysql();
        $result = $conn->update('ls_solicitudes', $res, $id);
        return $result;
    }
}
