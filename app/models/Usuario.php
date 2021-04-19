<?php

/**
 * This is the model class for table "Grupo".
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
 */
class Usuario
{
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

    public function __construct()
    {
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
    }

    public function set($id_wappersonas = null, $dni = null, $genero = null, $nombre = null, $apellido = null, $telefono = null, $email = null, $direccion_renaper = null, $fecha_nac = null, $empresa_cuil = null, $empresa_nombre = null)
    {
        $this->id_wappersonas = $id_wappersonas;
        $this->dni = $dni;
        $this->genero = $genero;
        $this->nombre = substr($nombre, 0, LT_USU_NOMBRE);
        $this->apellido = substr($apellido, 0, LT_USU_APELLIDO);
        $this->telefono = substr($telefono, 0, LT_USU_TELEFONO);
        $this->email = substr($email, 0, LT_USU_EMAIL);
        $this->direccion_renaper = substr($direccion_renaper, 0, LT_USU_DIRRENAPER);
        $this->fecha_nac = $fecha_nac;
        $this->empresa_cuil = $empresa_cuil;
        $this->empresa_nombre = $empresa_nombre;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        $result = $conn->store(USUARIOS, $array, 'iissssssssss');
        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al guardar un usuario';
            $log = new Log();
            $log->set($this->id_wappersonas, null, null, $error, get_class(), 'save');
            $log->save();
        }
        return $result;
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new BaseDatos();
        $usuarios = $conn->search(USUARIOS, $param, $ops);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al listar el usuario';
            $log = new Log();
            $log->set(null, null, null, $error, get_class(), 'list');
            $log->save();
        }
        return $usuarios;
    }

    public static function get($params)
    {
        $conn = new BaseDatos();
        $result = $conn->search(USUARIOS, $params);
        $usuario = $conn->fetch_assoc($result);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a obtener la solicitud: ' . $params['id'];
            $log = new Log();
            $log->set(null, null, null, $error, get_class(), 'get');
            $log->save();
        }
        return $usuario;
    }

    public static function update($res, $id)
    {
        $conn = new BaseDatos();
        $result = $conn->update(USUARIOS, $res, $id);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a modificar el usuario';
            $log = new Log();
            $log->set(null,  $id, null, $error, get_class(), 'update');
            $log->save();
        }
        return $result;
    }
}
