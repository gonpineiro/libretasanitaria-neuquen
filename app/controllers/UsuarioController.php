<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController
{
    /* Guarda un usuario */
    public function store($res)
    {
        $usuario = new Usuario();
        $values = array_values($res);
        $usuario->set(...$values);
        $usuario->save();
    }

    /* Busca todos los usuarios */
    static public function index()
    {
        return Usuario::list();
    }

    /* Busca un usuario */
    static public function get($id)
    {
        return Usuario::get($id);
    }

    /* Actualiza un usuario */
    static public function update($res, $id)
    {
       
        return Usuario::update($res, $id);
    }

    /* CODIGO VIEJO */
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */
    private function cargarObjeto($param)
    {
        $obj = null;

        if (
            array_key_exists('id', $param)
            and array_key_exists('id_wappersonas', $param) and $param['id_wappersonas'] != (null or '')
            and array_key_exists('telefono', $param) and $param['telefono'] != (null or '')
            and array_key_exists('email', $param) and $param['email'] != (null or '')
            and array_key_exists('ciudad', $param) and $param['ciudad'] != (null or '')
        ) {
            $obj = new Usuario();

            $obj->setear($param['id'], $param['id_wappersonas'], $param['telefono'], $param["email"], $param["ciudad"]);
        }

        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuario
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['id'])) {
            $obj = new Usuario();
            $obj->setId($param['id']);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['id'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     *
     * @param array $param
     */
    public function alta($param)
    {
        $resp = null;
        $param['id'] = null;
        $usuario = $this->cargarObjeto($param);
        if ($usuario != null and $usuario->insertar()) {
            $resp = $usuario;
        }
        return $resp;
    }

    /**
     * permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {
            $usuario = $this->cargarObjetoConClave($param);
            if ($usuario != null and $usuario->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $usuario = $this->cargarObjeto($param);
            if ($usuario != null and $usuario->modificar()) {
                $resp = $usuario;
            }
        }
        return $resp;
    }

    /**
     * Permite realizar la busqueda de un objeto por multiples campos y si se especifica, con operadores
     * específicos.
     * @param array $param arreglo del direccion 'campo' => 'valor buscado' o vacio si se necesitan listar todos
     * @param array $ops arreglo opcional del direccion 'campo' => 'operador', por defecto el operador es '='
     * @return Usuario[]
     */
    public function buscar($param = [], $ops = [])
    {
        $where = " 1=1 ";
        $values = array();
        foreach ($param as $key => $value) {
            $op = "=";
            if (isset($value)) {
                if (isset($ops[$key])) {
                    $op = $ops[$key];
                }
                $where .= " AND " . $key . $op . " ?";
                $values[] = $value;
            }
        }
        $arreglo = Usuario::listar($where, $values);
        return $arreglo;
    }
}
