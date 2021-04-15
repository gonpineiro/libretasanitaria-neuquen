<?php

/**
 * This is the model class for table "Grupo".
 * @property string $nombre
 * @property string $apellido
 * @property string $matricula
 * @property int $municipalidad_nqn
 * @property string $path_certificado
 * @property string $lugar_capacitacion
 * @property string $fecha_capacitacion
 * @property string $fecha_alta
 */
class Capacitador
{
    public $nombre;
    public $apellido;
    public $matricula;
    public $municipalidad_nqn;
    public $path_certificado;
    public $lugar_capacitacion;
    public $fecha_capacitacion;
    public $fecha_alta;

    public function __construct()
    {
        $this->nombre = "";
        $this->apellido = "";
        $this->matricula = "";
        $this->municipalidad_nqn = "";
        $this->path_certificado = "";
        $this->lugar_capacitacion = "";
        $this->fecha_capacitacion = "";
        $this->fecha_alta = date('d/m/Y H:i:s');
    }

    public function set($nombre = null, $apellido = null, $matricula = null, $municipalidad_nqn = null, $path_certificado = null, $lugar_capacitacion = null, $fecha_capacitacion = null)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->matricula = $matricula;
        $this->municipalidad_nqn = $municipalidad_nqn;
        $this->path_certificado = $path_certificado;
        $this->lugar_capacitacion = $lugar_capacitacion;
        $this->fecha_capacitacion = $fecha_capacitacion;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        return $conn->store(CAPACITADORES, $array, 'ssssss');
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new BaseDatos();
        $usuarios = $conn->search(CAPACITADORES, $param, $ops);
        return $usuarios;
    }

    public static function get($params)
    {
        $conn = new BaseDatos();
        $result = $conn->search(CAPACITADORES, $params);
        $usuario = $conn->fetch_assoc($result);
        return $usuario;
    }

    public static function update($res, $id)
    {
        $conn = new BaseDatos();
        $result = $conn->update(CAPACITADORES, $res, $id);
        return $result;
    }
}
