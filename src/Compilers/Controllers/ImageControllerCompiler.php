<?php

namespace WoodyNaDobhar\Dingo2Generators\Compilers\Controllers;


/**
 * Class ImageControllerCompiler
 * @package WoodyNaDobhar\Dingo2Generators\Compilers
 */
class ImageControllerCompiler extends CrudControllerCompiler
{
    /**
     * @param array $params
     * @return string
     */
    public function compile(array $params = []): string
    {
        $params['modelNameCamelcase'] = 'image';

        return parent::compile($params);
    }
}