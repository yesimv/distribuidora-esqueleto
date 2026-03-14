<?php

namespace App\Controllers\web;

use App\Auth\AuthUser;

class MenuController
{
    private $gdt;
    private $departamentos;
    private $agrupadosGdt;
    private $agrupadosDep;
    private $otros;

    public function __construct()
    {
        $this->gdt = ['Viajes', 'Flotilla', 'Reportes', 'Bonos', 'Mantenimiento', 'Almacen', 'Admin-gdt'];
        $this->departamentos = ['Empleados', 'Administracion'];
        $this->agrupadosGdt = [];
        $this->agrupadosDep = [];
        $this->otros = [];
        self::buildMenu();
    }

    private function buildMenu()
    {
        $modulos = AuthUser::getModulos();
        $array = json_decode(json_encode($modulos), true);
        foreach ($array as $tituloMenu => $modulo) {
            if (in_array($tituloMenu, $this->gdt)) {
                $this->agrupadosGdt[$tituloMenu] = $modulo;
            } else if (in_array($tituloMenu, $this->departamentos)) {
                $this->agrupadosDep[$tituloMenu] = $modulo;
            } else {
                $this->otros[$tituloMenu] = $modulo;
            }
        }
    }

    public  function getMenuGdt(){
        return $this->agrupadosGdt;
    }

    public  function getMenuAdmin(){
        return $this->agrupadosDep;
    }

    public  function getMenuOtros(){
        return $this->otros;
    }

}
