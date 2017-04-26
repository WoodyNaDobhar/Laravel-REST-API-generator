<?php

namespace TMPHP\RestApiGenerators\Compilers;


use TMPHP\RestApiGenerators\AbstractEntities\StubCompilerAbstract;

class SwaggerRootCompiler extends StubCompilerAbstract
{

    /**
     * SwaggerRootCompiler constructor.
     * @param null $saveToPath
     * @param null $saveFileName
     * @param null $stub
     */
    public function __construct($saveToPath = null, $saveFileName = null, $stub = null)
    {
        $saveToPath = base_path(config('rest-api-generator.paths.documentations'));
        $saveFileName = 'root-object.php';

        parent::__construct($saveToPath, $saveFileName, $stub);
    }

    /**
     * @param array $params
     * @return string
     */
    public function compile(array $params):string
    {
        //{{Host}}
        $this->stub = str_replace(
            '{{Host}}',
            $params['Host'],
            $this->stub
        );

        //saving
        $this->saveStub();

        //
        return $this->stub;
    }

}