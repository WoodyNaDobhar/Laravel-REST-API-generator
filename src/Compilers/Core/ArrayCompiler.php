<?php

namespace WoodyNaDobhar\Dingo2Generators\Compilers\Core;


use Illuminate\Support\Facades\Log;
use WoodyNaDobhar\Dingo2Generators\AbstractEntities\StubCompilerAbstract;

/**
 * Class ArrayCompiler
 * @package WoodyNaDobhar\Dingo2Generators\Compilers
 */
class ArrayCompiler extends StubCompilerAbstract
{

    /**
     * FillableArrayCompiler constructor.
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
     * @return bool|mixed|string
     */
    public function compile(array $params): string
    {

        //
        $this->replaceInStub([
            '{{comment}}' => $params['comment'],
            '{{name}}' => $params['name']
        ]);

        $this->compileFields($params['keys'], $params['values']);

        //
        return $this->stub;
    }

    /**
     * Compile list of fields for array
     *
     * @param array $keys
     * @param array $values
     */
    private function compileFields(array $keys, array $values)
    {
        $fields = '';

        if ($keys) {
            //todo write algo if $keys is passed
        } else {

            foreach ($values as $value) {
                $fields .= $value . ', ';
            }
        }

        //{{fields}}
        $this->replaceInStub(['{{fields}}' => $fields]);
    }

}