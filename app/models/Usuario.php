<?php

/**
 * This is the model class for table "Grupo".
 *
 * @property int $id
 * @property int $id_wappersonas
 * @property int $ciudad
 * @property int $nombre
 * @property int $apellido
 * @property int $fechaNac
 * @property int $genero
 * @property int $telefono
 * @property int $email
 * @property int $direccionRenaper
 * @property int $altura
 * @property string $timestamp
 *
 */
class Usuario
{
    public $id;
    public $nro_tramite;
    public $path_foto;
    public $dni;
    public $nombre;
    public $apellido;
    public $fecha_nac;
    public $genero;
    public $telefono;
    public $email;
    public $direccion_renaper;
    public $localidad;
    public $empresa_cuil;
    public $empresa_nombre;
    public $fecha_alta;

    public function __construct()
    {
        $this->id = "";
        $this->nro_tramite = "";
        $this->path_foto = "";
        $this->dni = "";
        $this->nombre = "";
        $this->apellido = "";
        $this->fecha_nac = "";
        $this->genero = "";
        $this->telefono = "";
        $this->email = "";
        $this->direccion_renaper = "";
        $this->localidad = "";
        $this->empresa_cuil = "";
        $this->empresa_nombre = "";
        $this->fecha_alta = "";
    }

    public function setear($id, $nro_tramite, $path_foto, $dni, $nombre, $apellido, $fecha_nac, $genero, $telefono, $email, $direccion_renaper, $localidad,  $empresa_cuil, $empresa_nombre, $fecha_alta = null)
    {
        $this->setId($id);
        $this->setNroTramite($nro_tramite);
        $this->setPathFoto($path_foto);
        $this->setDni($dni);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setFechaNac($fecha_nac);
        $this->setGenero($genero);
        $this->setTelefono($telefono);
        $this->setEmail($email);
        $this->setDireccionRenaper($direccion_renaper);
        $this->setLocalidad($localidad);
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
     * Get the value of nro_tramite
     */
    public function getNroTramite()
    {
        return $this->nro_tramite;
    }

    /**
     * Set the value of nro_tramite
     *
     * @return  self
     */
    public function setNroTramite($nro_tramite)
    {
        $this->nro_tramite = $nro_tramite;

        return $this;
    }

    /**
     * Get the value of path_foto
     */
    public function getPathFoto()
    {
        return $this->path_foto;
    }

    /**
     * Set the value of path_foto
     *
     * @return  self
     */
    public function setPathFoto($path_foto)
    {
        $this->path_foto = $path_foto;

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
     * @return string
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * @param string $localidad
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
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
