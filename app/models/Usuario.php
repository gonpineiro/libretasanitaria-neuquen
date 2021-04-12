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
class Usuario {
    public $id;
    public $id_wappersonas;
    public $telefono;
    public $email;
    public $ciudad;
    public $fechaAlta;
    public $mensajeoperacion;

    public function __construct()
    {
        $this->id = "";
        $this->id_wappersonas = "";
        $this->telefono = "";
        $this->email = "";
        $this->ciudad = "";
        $this->setmensajeoperacion = "";
    }

    
    public function setear($id, $id_wappersonas, $telefono, $email, $ciudad, $fechaAlta = null)
    {
        $this->setId($id);
        $this->setid_wappersonas($id_wappersonas);
        $this->setTelefono($telefono);
        $this->setEmail($email);
        $this->setCiudad($ciudad);
        $this->setFechaAlta($fechaAlta);
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
    public function getid_wappersonas()
    {
        return $this->id_wappersonas;
    }

    /**
     * Set the value of id_wappersonas
     *
     * @return  self
     */ 
    public function setid_wappersonas($id_wappersonas)
    {
        $this->id_wappersonas = $id_wappersonas;

        return $this;
    }

    /**
     * Get the value of ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     *
     * @return  self
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    
    /**
     * Get the value of fechaAlta
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set the value of fechaAlta
     *
     * @return  self
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    /**
     * @param string $mensajeoperacion
     */
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM ferias_usuario WHERE id = ?";
        $params = Array($this->getId());
        
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
        $res = $base->executeQuery($query,false, $valor);
        if ($res) {
            while ($row = $base->Registro($query)) {
                $obj = new Usuario();
                $obj->setear($row['id'], $row['id_wappersonas'],$row['telefono'], $row['email'], $row['ciudad'],$row["fechaAlta"]);
                array_push($arreglo, $obj);
            }
        }
        return $arreglo;
    }
}