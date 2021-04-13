<?php

namespace App\Models;

use App\Connections\ConnectMysql;

/**
 * This is the model class for table "Grupo".
 *
 * @property int $id
 * @property int $nro_tramite
 * @property string $path_foto
 * @property int $dni
 * @property string $nombre
 * @property string $apellido
 * @property string $fecha_nac
 * @property string $genero
 * @property int $telefono
 * @property string $email
 * @property string $direccion_renaper
 * @property string $localidad
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
        $this->setId($id);
        $this->setIdWappersonas($id_wappersonas);
        $this->setDni($dni);
        $this->setGenero($genero);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setTelefono($telefono);
        $this->setEmail($email);
        $this->setDireccionRenaper($direccion_renaper);
        $this->setFechaNac($fecha_nac);
        $this->setEmpresaCuil($empresa_cuil);
        $this->setEmpresaNombre($empresa_nombre);
        $this->setFechaAlta($fecha_alta);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of id_wappersonas
     */
    public function getIdWappersonas()
    {
        return $this->id_wappersonas;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setIdWappersonas($id_wappersonas)
    {
        $this->id_wappersonas = $id_wappersonas;
        return $this;
    }

    /**
     * Get the value of dni
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of nro_tramite
     *
     * @return  self
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param string $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param string $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDireccionRenaper()
    {
        return $this->direccion_renaper;
    }

    /**
     * @param string $direccion_renaper
     */
    public function setDireccionRenaper($direccion_renaper)
    {
        $this->direccion_renaper = $direccion_renaper;
    }

    /**
     * Get the value of fecha_nac
     */
    public function getFechaNac()
    {
        return $this->fecha_nac;
    }

    /**
     * Set the value of fecha_nac
     *
     * @return  self
     */
    public function setFechaNac($fecha_nac)
    {
        $this->fecha_nac = $fecha_nac;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmpresaCuil()
    {
        return $this->empresa_cuil;
    }

    /**
     * @param string $empresa_cuil
     */
    public function setEmpresaCuil($empresa_cuil)
    {
        $this->empresa_cuil = $empresa_cuil;
    }

    /**
     * @return string
     */
    public function getEmpresaNombre()
    {
        return $this->empresa_nombre;
    }

    /**
     * @param string $empresa_nombre
     */
    public function setEmpresaNombre($empresa_nombre)
    {
        $this->empresa_nombre = $empresa_nombre;
    }

    /**
     * @return string
     */
    public function getFechaAlta()
    {
        return $this->fecha_alta;
    }

    /**
     * @param string $fecha_alta
     */
    public function setFechaAlta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        unset($array['id']);
        $conn = new ConnectMysql();
        $conn->store('ls_usuarios', $array, 'ssssssssssss');
    }

    public static function list()
    {
        $conn = new ConnectMysql();
        $usuarios = $conn->search('ls_usuarios');
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

    /* CODIGO VIEJO */
    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM ferias_usuario WHERE id = ?";
        $params = array($this->getId());

        if ($base) {
            $query = $base->prepareQuery($sql);
            $res = $base->executeQuery($query, false, $params, get_class($this));
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro($query);
                    $this->setear($row['id'], $row['id_wappersonas'], $row['telefono'], $row['email'], $row['ciudad']);
                }
            }
        } else {
            $this->setmensajeoperacion(get_class($this) . "->cargar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = $this;
        $base = new BaseDatos();
        $sql = "INSERT INTO ferias_usuario( id_wappersonas, telefono, email, ciudad)  ";
        $sql .= "VALUES(?, ?, ?, ?)";
        $params = [$this->getid_wappersonas(), $this->getTelefono(), $this->getEmail(), $this->getCiudad()];
        if ($base) {
            $query = $base->prepareQuery($sql);
            if ($elid = $base->executeQuery($query, true, $params, get_class($this))) {
                $this->setId($elid);
            } else {
                $this->setmensajeoperacion(get_class($this) . "->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion(get_class($this) . "->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = $this;
        $base = new BaseDatos();
        $sql = "UPDATE ferias_usuario SET id_wappersonas=?, telefono=?, email=?,ciudad=? ";
        $sql .= " WHERE id = ?";
        $params = [$this->getid_wappersonas(), $this->getTelefono(), $this->getEmail(), $this->getCiudad(), $this->getId()];
        if ($base) {
            $query = $base->prepareQuery($sql);
            if ($base->executeQuery($query, false, $params, get_class($this))) {
                $resp = $this;
            } else {
                $this->setmensajeoperacion(get_class($this) . "->modificar 1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion(get_class($this) . "->modificar 2: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM ferias_usuario WHERE id =?";
        $params = array($this->getId());
        if ($base) {
            $query = $base->prepareQuery($sql);
            if ($base->executeQuery($query, false, $params)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion(get_class($this) . "->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion(get_class($this) . "->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "1=1", $valor = [])
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM ferias_usuario ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $query = $base->prepareQuery($sql);
        $res = $base->executeQuery($query, false, $valor);
        if ($res) {
            while ($row = $base->Registro($query)) {
                $obj = new Usuario();
                $obj->setear($row['id'], $row['id_wappersonas'], $row['telefono'], $row['email'], $row['ciudad'], $row["fechaAlta"]);
                array_push($arreglo, $obj);
            }
        }
        return $arreglo;
    }
}
