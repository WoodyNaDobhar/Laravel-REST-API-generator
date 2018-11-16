<?php

namespace WoodyNaDobhar\Dingo2Generators\Commands;


use Illuminate\Console\Command;
use WoodyNaDobhar\Dingo2Generators\Compilers\Swagger\SwaggerRootCompiler;
use WoodyNaDobhar\Dingo2Generators\Support\Helper;

/**
 * Class MakeSwaggerRootCommand
 * @package WoodyNaDobhar\Dingo2Generators\Commands
 */
class MakeSwaggerRootCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:swagger-root';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate root object for swagger documentation.';


    /**
     * Execute the console command.
     *
     * TODO add command execution to composer update.
     *
     * @return void
     */
    public function fire()
    {
        $swaggerRootCompiler = new SwaggerRootCompiler();

        $host = Helper::trimProtocolFromUrl(env('APP_URL'));

        $swaggerRootCompiler->compile(['Host' => $host]);

        $this->info('make:swagger-root cmd executed ' . $host);
    }

}