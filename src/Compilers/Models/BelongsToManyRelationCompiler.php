<?php

namespace WoodyNaDobhar\Dingo2Generators\Compilers\Models;


use WoodyNaDobhar\Dingo2Generators\AbstractEntities\StubCompilerAbstract;

/**
 * Class BelongsToManyRelationCompiler
 * @package WoodyNaDobhar\Dingo2Generators\Compilers
 */
class BelongsToManyRelationCompiler extends StubCompilerAbstract
{

    /**
     * HasManyRelationCompiler constructor.
     * @param null $saveToPath
     * @param null $saveFileName
     * @param null $stub
     */
    public function __construct($saveToPath = null, $saveFileName = null, $stub = null)
    {
        $saveToPath = base_path(config('rest-api-generator.paths.models'));
        $saveFileName = '';

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
            '{{relatedModelStudlyCasePlural}}' => $params['relatedModelStudlyCasePlural'],
            '{{relatedModelStudlyCaseSingular}}' => $params['relatedModelStudlyCaseSingular'],
            '{{relationName}}' => $params['relationName'],//todo change to relationName
            '{{relatedModelCamelCaseSingular}}' => $params['relatedModelCamelCaseSingular'],
            '{{pivotTableName}}' => $params['pivotTableName'],
            '{{modelsNamespace}}' => $params['modelsNamespace'],
            '{{foreignKey}}' => $params['foreignKey'],
            '{{relatedKey}}' => $params['relatedKey'],
        ]);

        //
        return $this->stub;
    }

}