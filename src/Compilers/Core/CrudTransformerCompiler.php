<?php

namespace WoodyNaDobhar\Dingo2Generators\Compilers\Core;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Log;
use WoodyNaDobhar\Dingo2Generators\AbstractEntities\StubCompilerAbstract;

/**
 * Class CrudTransformerCompiler
 * @package WoodyNaDobhar\Dingo2Generators\Compilers
 */
class CrudTransformerCompiler extends StubCompilerAbstract
{

    /**
     * @var string
     */
    private $transformersNamespace;

    /**
     * @var string
     */
    private $modelsNamespace;

    /**
     * CrudTransformerCompiler constructor.
     * @param null $saveToPath
     * @param null $saveFileName
     * @param null $stub
     */
    public function __construct($saveToPath = null, $saveFileName = null, $stub = null)
    {
        $saveToPath = base_path(config('rest-api-generator.paths.transformers'));
        $saveFileName = '';

        $this->transformersNamespace = config('rest-api-generator.namespaces.transformers');
        $this->modelsNamespace = config('rest-api-generator.namespaces.models');

        parent::__construct($saveToPath, $saveFileName, $stub);
    }

    /**
     * @param array $params
     * @return bool|mixed|string
     */
    public function compile(array $params): string
    {
        //
        $this->saveFileName = ucfirst($params['modelNameCamelcase']) . 'Transformer.php';

        $availableIncludesArray = new ArrayCompiler();
        $arrayValues = $this->getModelRelations($params['modelNameCamelcase']);
        $availableIncludesArrayCompiled = $availableIncludesArray->compile([
            'keys' => [],
            'values' => $arrayValues,
            'comment' => '',
            'name' => 'availableIncludes',
        ]);

        //
        $this->replaceInStub([
            '{{Model}}' => ucfirst($params['modelNameCamelcase']),
            '{{transformersNamespace}}' => $this->transformersNamespace,
            '{{AvailableIncludesArray}}' => $availableIncludesArrayCompiled,
        ]);

        //
        $this->saveStub();

        //
        return $this->stub;
    }

    /**
     * Get the names of model's relations by model name.
     * @param string $modelName
     * @return array the names of model's relations
     */
    private function getModelRelations(string $modelName): array
    {
        $relations = [];

        $modelFullClassName = $this->modelsNamespace . '\\' . studly_case($modelName);

        $model = new $modelFullClassName();

        $reflectionClass = new \ReflectionClass($modelFullClassName);

        //get methods, which are declared in model class
        $methods = [];
        foreach ($reflectionClass->getMethods() as $method) {
            if ($method->class == $modelFullClassName) {
                $methods[] = $method->name;
            }
        }

        //check methods, whether they are relations and add their names if yes
        foreach ($methods as $method) {

            if (!starts_with($method,'scope')){
                try {
                    $methodResult = $model->$method();
                }
                catch (\Exception $e){
                    Log::error('Try to fix this - relation is executing before model was generated.');
                    Log::error($e->getMessage());
                    $relations[] = "'$method'";
                    $methodResult = null;
                }

                if ($methodResult instanceof Relation) {
                    $relations[] = "'$method'";
                }
            }
        }

        return $relations;
    }


}