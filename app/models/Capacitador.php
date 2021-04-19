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

    public function __construct()
    {
        $this->nombre = "";
        $this->apellido = "";
        $this->matricula = "";
        $this->municipalidad_nqn = "";
        $this->path_certificado = "";
        $this->lugar_capacitacion = "";
        $this->fecha_capacitacion = "";
    }

    public function set($nombre = null, $apellido = null, $matricula = null, $municipalidad_nqn = null, $path_certificado = null, $lugar_capacitacion = null, $fecha_capacitacion = null)
    {
        $this->nombre = substr($nombre, 0, LT_CAP_NOMBRE);
        $this->apellido = substr($apellido, 0, LT_CAP_APELLIDO);
        $this->matricula = substr($matricula, 0, LT_CAP_MATRICULA);
        $this->municipalidad_nqn = $municipalidad_nqn;
        $this->path_certificado = $path_certificado;
        $this->lugar_capacitacion = substr($lugar_capacitacion, 0, LT_CAP_LUCAPACITACION);
        $this->fecha_capacitacion = $fecha_capacitacion;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        $result = $conn->store(CAPACITADORES, $array, 'ssssss');

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al guardar un capacitador';
            $log = new Log();
            $log->set(null, null, null, $error, get_class(), 'save');
            $log->save();
        }
        return $result;
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new BaseDatos();
        $usuarios = $conn->search(CAPACITADORES, $param, $ops);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al listar los capacitadores';
            $log = new Log();
            $log->set(null, null, null, $error, get_class(), 'list');
            $log->save();
        }
        return $usuarios;
    }

    public static function get($params)
    {
        $conn = new BaseDatos();
        $result = $conn->search(CAPACITADORES, $params);
        $usuario = $conn->fetch_assoc($result);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a obtener el capacitador: ' . $params['id'];
            $log = new Log();
            $log->set(null, null, $params['id'], $error, get_class(), 'get');
            $log->save();
        }
        return $usuario;
    }

    public static function update($res, $id)
    {
        $conn = new BaseDatos();
        $result = $conn->update(CAPACITADORES, $res, $id);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a modificar el capacitador';
            $log = new Log();
            $log->set(null,  $id, null, $error, get_class(), 'update');
            $log->save();
        }
        return $result;
    }
}
