<?php

namespace App\Controllers;

use App\Models\Solicitud;

class SolicitudController
{
    /* Guarda un solicitud */
    public function store($res)
    {
        $solicitud = new Solicitud();
        $values = array_values($res);
        $solicitud->set(...$values);
        $solicitud->save();
    }

    /* Busca todos los solicitud */
    static public function index($param = [], $ops = [])
    {
        return Solicitud::list($param, $ops);
    }

    /* Busca un solicitud */
    static public function get($id)
    {
        return Solicitud::get($id);
    }

    /* Actualiza un solicitud */
    static public function update($res, $id)
    {

        return Solicitud::update($res, $id);
    }

    /* CODIGO VIEJO */
    /**
     * @param array $param
     * @return Solicitud
     */
    private function cargarObjeto($param)
    {
        $obj = null;

        if (
            array_key_exists('id', $param)
            and array_key_exists('id_usuario', $param) and $param['id_usuario'] != (null or '')
            and array_key_exists('feria', $param) and $param['feria'] != (null or '')
            and array_key_exists('nombre_emprendimiento', $param) and $param['nombre_emprendimiento'] != (null or '')
            and array_key_exists('rubro_emprendimiento', $param) and $param['rubro_emprendimiento'] != (null or '')
            and array_key_exists('producto', $param) and $param['producto'] != (null or '')
            and array_key_exists('previa_participacion', $param) and $param['previa_participacion'] != (null or '')
        ) {

            $obj = new Solicitud();

            if (!array_key_exists('instagram', $param)) {
                $param['instagram'] = null;
            }
            if (!array_key_exists('observacion', $param)) {
                $param['observacion'] = null;
            }

            $obj->setear($param['id'], $param['id_usuario'], $param['feria'], $param['nombre_emprendimiento'], $param["rubro_emprendimiento"], $param['producto'], $param['instagram'], $param['previa_participacion'], $param['estado'], $param['observacion']);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return Solicitud
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['id'])) {
            $obj = new Solicitud();
            $obj->setId($param['id']);
        }
        return $obj;
    }


    /**
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['id']))
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     * @return Solicitud|false|null
     */
    public function alta($param)
    {
        $resp = null;
        $param['id'] = null;
        $solicitud = $this->cargarObjeto($param);
        if ($solicitud != null and $solicitud->insertar()) {
            $resp = $solicitud;
            if ($solicitud->getMensajeoperacion() != (null or '')) {
                cargarLog($solicitud->getId_usuario(), null, 'Alta solicitud: ' . $solicitud->getMensajeoperacion());
            }
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
            $solicitud = $this->cargarObjetoConClave($param);
            if ($solicitud != null and $solicitud->eliminar()) {
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
            $solicitud = $this->cargarObjeto($param);
            if ($solicitud != null and $solicitud->modificar()) {
                $resp = $solicitud;
            }
        }
        return $resp;
    }

    /**
     * Permite realizar la busqueda de un objeto por multiples campos y si se especifica, con operadores
     * específicos.
     * @param array $param arreglo del tipo 'campo' => 'valor buscado' o vacio si se necesitan listar todos
     * @param array $ops arreglo opcional del tipo 'campo' => 'operador', por defecto el operador es '='
     * @return Solicitud[]
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
        $arreglo = Solicitud::listar($where, $values);
        return $arreglo;
    }
}
