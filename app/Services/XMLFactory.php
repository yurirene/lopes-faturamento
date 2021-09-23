<?php

namespace App\Services;

class XMLFactory
{
    private $services = [
        1 => 'XMLTourinhoService',
        2 => 'XMLCatupiryService',
        3 => 'XMLDanoneService'
    ];

    public function service($industria)
    {
        $classe = $this->services[$industria];
        return "\App\Services\\$classe"; 
    }
}