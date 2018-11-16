<?php

namespace WoodyNaDobhar\Dingo2Generators\Compilers\Scopes;

use WoodyNaDobhar\Dingo2Generators\AbstractEntities\StubCompilerAbstract;

/**
 * Class WhereIntegerScopeCompiler
 * @package WoodyNaDobhar\Dingo2Generators\Compilers\Scopes
 */
class WhereIntegerScopeCompiler extends StubCompilerAbstract
{

    /**
     * WhereScopeCompiler constructor.
     *
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
     *
     * @return string
     */
    public function compile(array $params): string
    {
        /** @var \Doctrine\DBAL\Schema\Column $column */
        $column = $params['column'];
        $columnName = $column->getName();

        //
        $this->replaceInStub([
            '{{columnName}}' => $columnName,
            '{{columnNameStudlyCase}}' => studly_case($column->getName()),
        ]);

        return $this->stub;
    }
}