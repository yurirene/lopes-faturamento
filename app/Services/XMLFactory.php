<?php

namespace App\Services;

class XMLFactory
{
    /**
     * Retorna o path do Service que irá importar o XML
     *
     * @param string $classe
     * @return string
     */
    public function service(string $classe): string
    {
        return "\App\Services\\$classe";
    }
}
