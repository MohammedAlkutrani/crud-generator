<?php

namespace ION\Crud\Commands;


use ION\Crud\Generator;
use ION\Crud\Bootstrapper;
use ION\Crud\Generators\Model;
use Illuminate\Console\Command;
use ION\Crud\Generators\Request;
use ION\Crud\Generators\Resource;
use ION\Crud\Generators\Migration;
use ION\Crud\Generators\Controller;


class CrudCommand extends Command
{
    /**
     *
     */
    protected $name;

    /**
     *
     */
    protected $fields = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name} {--f=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $generator = (new Bootstrapper)
            ->setName($this->argument('name'))
            ->setFields($this->option('f'));

        $generator = new Generator();
        $generator = new Migration($generator);
        $generator = new Request($generator);
        $generator = new Model($generator);
        $generator = new Resource($generator);
        $generator = new Controller($generator);

        $generator->exec();
        $this->info($generator->whatDidYouDo());
        return 0;
    }
}
