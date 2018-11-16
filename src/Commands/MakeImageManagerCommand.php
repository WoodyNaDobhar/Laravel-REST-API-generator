<?php

namespace WoodyNaDobhar\Dingo2Generators\Commands;


use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use WoodyNaDobhar\Dingo2Generators\Compilers\Controllers\ImageControllerCompiler;
use WoodyNaDobhar\Dingo2Generators\Compilers\Routes\ImageRoutesCompiler;

/**
 * Class MakeImageManagerCommand
 * @package WoodyNaDobhar\Dingo2Generators\Commands
 */
class MakeImageManagerCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:image-manager-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold api for image management.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        //run migrations
        $this->migrateRequiredTables();

        //generate models, controllers, definitions and transformers
        $this->scaffoldCode();

        //create storage link to public folder
        Artisan::call('storage:link');

        $this->info('make:image-manager-api command executed');
    }

    /**
     * Create missed tables in the database schema.
     * ('images', 'acl_groups', 'acl_action_group', 'acl_group_user')
     */
    private function migrateRequiredTables()
    {
        if (!Schema::hasTable('images')) {
            Schema::create('images', function (Blueprint $table) {
                $table->increments('id');
                $table->string('image_src');
                $table->timestamps();
            });
        }

    }

    private function scaffoldCode()
    {
        //scaffold model
        Artisan::call('make:crud-models', [
            '--models' => 'Image',
            '--tables' => 'images',
        ]);

        //scaffold transformer
        Artisan::call('make:crud-transformers', [
            '--models' => 'Image',
        ]);

        //scaffold controller
        $imageControllerCompiler = new ImageControllerCompiler();
        $imageControllerCompiler->compile();


        //scaffold swagger model
        Artisan::call('make:swagger-models', [
            '--models' => 'image',
            '--tables' => 'images',
        ]);

        //scaffold image management routes
        $imageRoutesCompiler = new ImageRoutesCompiler();
        $imageRoutesCompiler->compile();

        $this->info('All code for image management generated!');
    }

}