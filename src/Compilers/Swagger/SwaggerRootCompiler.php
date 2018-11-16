<?php

namespace WoodyNaDobhar\Dingo2Generators\Compilers\Swagger;


use WoodyNaDobhar\Dingo2Generators\AbstractEntities\StubCompilerAbstract;

/**
 * Class SwaggerRootCompiler
 * @package WoodyNaDobhar\Dingo2Generators\Compilers
 */
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
    public function compile(array $params): string
    {
        //
        $this->replaceInStub([
            '{{Host}}' => $params['Host'],
        ]);

        //saving
        $this->saveStub();

        //
        return $this->stub;
    }

}