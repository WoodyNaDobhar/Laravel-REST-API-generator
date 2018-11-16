<?php

namespace WoodyNaDobhar\Dingo2Generators\Compilers\Swagger;


use Illuminate\Support\Facades\Log;
use WoodyNaDobhar\Dingo2Generators\AbstractEntities\StubCompilerAbstract;

/**
 * Class SwaggerFiltersCompiler
 * @package WoodyNaDobhar\Dingo2Generators\Compilers\Swagger
 */
class SwaggerFiltersCompiler extends StubCompilerAbstract
{

    /**
     * SwaggerFiltersCompiler constructor.
     * @param null $saveToPath
     * @param null $saveFileName
     * @param null $stub
     */
    public function __construct($saveToPath = null, $saveFileName = null, $stub = null)
    {
        $saveToPath = base_path(config('rest-api-generator.paths.documentations'));
        $saveFileName = '';

        parent::__construct($saveToPath, $saveFileName, $stub);
    }

    /**
     * @param array $params
     * @return bool|mixed|string
     */
    public function compile(array $params): string
    {

        //todo add comments generation (what filters are acceptable)
//        $this->replaceInStub([
//            '{{filters}}' => strtolower($params['']),
//        ]);

        //
        return $this->stub;
    }

}