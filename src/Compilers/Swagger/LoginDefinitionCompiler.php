<?php

namespace WoodyNaDobhar\Dingo2Generators\Compilers\Swagger;


use WoodyNaDobhar\Dingo2Generators\AbstractEntities\StubCompilerAbstract;


/**
 * Class LoginDefinitionCompiler
 * @package WoodyNaDobhar\Dingo2Generators\Compilers
 */
class LoginDefinitionCompiler extends StubCompilerAbstract
{

    /**
     * LoginDefinitionCompiler constructor.
     * @param null $saveToPath
     * @param null $saveFileName
     * @param null $stub
     */
    public function __construct($saveToPath = null, $saveFileName = null, $stub = null)
    {
        $saveToPath = base_path(config('rest-api-generator.paths.documentations'));
        $saveFileName = 'login.php';

        parent::__construct($saveToPath, $saveFileName, $stub);
    }

    /**
     * @param array $params
     * @return bool|mixed|string
     */
    public function compile(array $params): string
    {
        //
        $this->saveStub();

        //
        return $this->stub;
    }

}