<?php

namespace WoodyNaDobhar\Dingo2Generators\Commands;


use Illuminate\Console\Command;
use WoodyNaDobhar\Dingo2Generators\Compilers\Controllers\CrudControllerCompiler;

/**
 * Class MakeCrudControllersCommand
 * @package WoodyNaDobhar\Dingo2Generators\Commands
 */
class MakeCrudControllersCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:crud-controllers 
                            {--models= : List of models, written as CSV in camelCase notation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold controllers for REST API.';


    /**
     * @var array list of model names.
     */
    private $models = [];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        //get list of models
        $this->models = explode(',', $this->option('models'));

        //check whether model names were submitted
        if (strlen($this->models[0]) === 0) {
            $this->error('Please specify model names in camelCase notation');

            return;
        }

        //compile CRUD controllers for all models
        foreach ($this->models as $model) {
            $crudControllerCompiler = new CrudControllerCompiler();
            $crudControllerCompiler->compile([
                'modelNameCamelcase' => $model,
            ]);
        }

        $this->info('make:crud-controllers cmd executed');
    }

}