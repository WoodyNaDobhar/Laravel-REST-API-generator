<?php

namespace WoodyNaDobhar\Dingo2Generators\Compilers\Swagger;


use WoodyNaDobhar\Dingo2Generators\AbstractEntities\StubCompilerAbstract;
use WoodyNaDobhar\Dingo2Generators\Support\SchemaManager;

/**
 * Class SwaggerDefinitionCompiler
 * @package WoodyNaDobhar\Dingo2Generators\Compilers
 */
class SwaggerDefinitionCompiler extends StubCompilerAbstract
{

    /**
     * @var SchemaManager
     */
    private $schema;

    /**
     * SwaggerDefinitionCompiler constructor.
     * @param null $saveToPath
     * @param null $saveFileName
     * @param null $stub
     */
    public function __construct($saveToPath = null, $saveFileName = null, $stub = null)
    {
        $saveToPath = base_path(config('rest-api-generator.paths.documentations'));
        $saveFileName = '';

        $this->schema = new SchemaManager();

        parent::__construct($saveToPath, $saveFileName, $stub);
    }

    /**
     * @param array $params
     * @return bool|mixed|string
     */
    public function compile(array $params): string
    {

        //
        $this->saveFileName = $params['modelName'] . '.php';

        //
        $compiledProperties = '';

        /** @var \Doctrine\DBAL\Schema\Column[] */
        $columns = $this->schema->listTableColumns($params['tableName']);

        //compile swagger properties for table columns
        foreach ($columns as $column) {
            $swaggerPropertyCompiler = new SwaggerPropertyCompiler();
            $compiledProperties .= $swaggerPropertyCompiler->compile([
                'name' => $column->getName(),
                'type' => $column->getType(),
                'format' => 'default'
            ]);
        }

        //
        $this->replaceInStub([
            '{{ModelLowercase}}' => $params['modelName'],
            '{{SwaggerProperties}}' => $compiledProperties,
        ]);

        //
        $this->saveStub();

        //
        return $this->stub;
    }

}