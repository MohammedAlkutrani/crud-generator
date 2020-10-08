<?php

namespace ION\Crud\Generators;

use Illuminate\Support\Facades\File;
use ION\Crud\GeneratorDacorator;
use Illuminate\Support\Str;

class Model extends GeneratorDacorator
{
    /**
     *
     */
    private $modelTemplate;

    /**
     *
     */
    private $modelFileName;

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
        File::put(app_path('Models').DIRECTORY_SEPARATOR.$this->modelFileName,$this->modelTemplate);
        $this->output = $this->getClassName().' model file created';
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
        $this->modelTemplate = Str::of($this->getStub('model'))
            ->replace('{{ class }}', $this->getClassName())
            ->replace('{{ fillable }}',$this->createFields(function($field){
                return "'$field[0]'";
            },', '));
    }

    /**
     *
     */
    private function setFileName()
    {
        $this->modelFileName = $this->getClassName().'.php';
    }

    /**
     *
     */
    public function getClassName()
    {
        return Str::studly(self::$name);
    }
}
