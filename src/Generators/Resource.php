<?php

namespace ION\Crud\Generators;

use Illuminate\Support\Facades\File;
use ION\Crud\GeneratorDacorator;
use Illuminate\Support\Str;

class Resource extends GeneratorDacorator
{
    /**
     *
     */
    private $resourceTemplate;

    /**
     *
     */
    private $resourceFileName;

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

        if(!File::isDirectory(app_path('Http'.DIRECTORY_SEPARATOR.'Resources')))
        {
            File::makeDirectory(app_path('Http'.DIRECTORY_SEPARATOR.'Resources'),0777);
        }

        File::put(app_path('Http'.DIRECTORY_SEPARATOR.'Resources').DIRECTORY_SEPARATOR.$this->resourceFileName,$this->resourceTemplate);

        $this->output = $this->getClassName(). ' resource file created';
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
        $this->resourceTemplate = Str::of($this->getStub('resource'))
            ->replace('{{ class }}', $this->getClassName())
            ->replace('{{ response }}',$this->createFields(function($field){
                return "'$field[0]' => ".'$this->'."$field[0]";
            },','.PHP_EOL));
    }

    /**
     *
     */
    private function setFileName()
    {
        $this->resourceFileName = $this->getClassName().'.php';
    }

    /**
     *
     */
    public function getClassName()
    {
        return Str::studly(self::$name).'Resource';
    }
}
