<?php

namespace ION\Crud\Generators;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use ION\Crud\GeneratorDacorator;
use Illuminate\Support\Str;

class Migration extends GeneratorDacorator
{
    /**
     *
     */
    private $migrationTemplate;

    /**
     *
     */
    private $migrationFileName;

    /**
     *
     */
    private $output;

    /**
     *
     */
    public function generate(): void
    {
        $this->prepare();
        $this->setFileName();
        File::put(database_path('migrations').DIRECTORY_SEPARATOR.$this->migrationFileName,$this->migrationTemplate);
        $this->output = Str::studly(self::$name).' migraion file created';
    }

    /**
     *
     */
    public function output()
    {
        return $this->output;
    }

    /**
     *
     */
    private function prepare()
    {
        $this->migrationTemplate = Str::of($this->getStub('migration'))
            ->replace('{{ class }}', $this->getClassName())
            ->replace('{{ table }}', $this->getTableName())
            ->replace('{{ fields }}',$this->createFields(function($field){
                return '$table->'.$field[1].'('."'$field[0]'".');';
            },PHP_EOL));
    }

    /**
     *
     */
    private function setFileName()
    {
        $this->migrationFileName = Str::of(
                Carbon::now()
                ->toDateTimeString())
                ->replace('-','_')
                ->replace(' ','_')
                ->replace(':','')
                .'_create_'.Str::plural(self::$name).'_table.php';
    }

    /**
     *
     */
    public function getClassName()
    {
        return 'Create'.Str::studly(self::$name).'Table';
    }

    /**
     *
     */
    public function getTableName()
    {
        return Str::plural(self::$name);
    }
}

