<?php

namespace App\Models;

use App\Connections\ConnectMysql;

/**
 * This is the model class for table "Grupo".
 *
 * @property int $id
 * @property int $id_wappersonas
 * @property int $dni
 * @property string $genero
 * @property string $nombre
 * @property string $apellido
 * @property int $telefono
 * @property string $email
 * @property string $direccion_renaper
 * @property string $fecha_nac
 * @property int $empresa_cuil
 * @property string $empresa_nombre
 * @property timestamp $fecha_alta
 *
 */
class Usuario
{
    public $id;
    public $id_wappersonas;
    public $dni;
    public $genero;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $direccion_renaper;
    public $fecha_nac;
    public $empresa_cuil;
    public $empresa_nombre;
    public $fecha_alta;

    public function __construct()
    {
        $this->id = "";
        $this->id_wappersonas = "";
        $this->dni = "";
        $this->genero = "";
        $this->nombre = "";
        $this->apellido = "";
        $this->telefono = "";
        $this->email = "";
        $this->direccion_renaper = "";
        $this->fecha_nac = "";
        $this->empresa_cuil = "";
        $this->empresa_nombre = "";
        $this->fecha_alta = "";
    }

    public function set($id, $id_wappersonas = null, $dni = null, $genero = null, $nombre = null, $apellido = null, $telefono = null, $email = null, $direccion_renaper = null, $fecha_nac = null, $empresa_cuil = null, $empresa_nombre = null, $fecha_alta = null)
    {
        $this->id = $id;
        $this->id_wappersonas = $id_wappersonas;
        $this->dni = $dni;
        $this->genero = $genero;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion_renaper = $direccion_renaper;
        $this->fecha_nac = $fecha_nac;
        $this->empresa_cuil = $empresa_cuil;
        $this->empresa_nombre = $empresa_nombre;
        $this->fecha_alta = $fecha_alta;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        unset($array['id']);
        $conn = new ConnectMysql();
        $conn->store('ls_usuarios', $array, 'ssssssssssss');
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new ConnectMysql();
        $usuarios = $conn->search('ls_usuarios', $param, $ops);
        return $usuarios;
    }

    public static function get($id)
    {
        $conn = new ConnectMysql();
        $params = ['id' => $id];
        $result = $conn->search('ls_usuarios', $params);
        $usuario = $conn->fetch_assoc($result);
        return $usuario;
    }

    public static function update($res, $id)
    {
        $conn = new ConnectMysql();
        $result = $conn->update('ls_usuarios', $res, $id);
        return $result;
    }

}
