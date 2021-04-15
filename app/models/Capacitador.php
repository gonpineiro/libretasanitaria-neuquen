<?php

namespace App\Models;

use App\Connections\BaseDatos;
use App\Connections\ConnectMysql;

/**
 * This is the model class for table "Grupo".
 * @property string $nombre
 * @property string $apellido
 * @property string $matricula
 * @property string $path_certificado
 * @property string $lugar_capacitacion
 * @property string $fecha_capacitacion
 */
class Capacitador
{
    public $nombre;
    public $apellido;
    public $matricula;
    public $path_certificado;
    public $lugar_capacitacion;
    public $fecha_capacitacion;

    public function __construct()
    {
        $this->nombre = "";
        $this->apellido = "";
        $this->matricula = "";
        $this->path_certificado = "";
        $this->lugar_capacitacion = "";
        $this->fecha_capacitacion = "";
    }

    public function set($nombre = null, $apellido = null, $matricula = null, $path_certificado = null, $lugar_capacitacion = null, $fecha_capacitacion = null)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->matricula = $matricula;
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

    public static function getLast()
    {
        $conn = new BaseDatos();
        $result = $conn->getLast(CAPACITADORES);
        $id = $conn->fetch_assoc($result);
        return $id;
    }
}
