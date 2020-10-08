<?php

namespace ION\Crud\Generators;

use Illuminate\Support\Facades\File;
use ION\Crud\GeneratorDacorator;
use Illuminate\Support\Str;

class Request extends GeneratorDacorator
{
    /**
     *
     */
    private $requestTemplate;

    /**
     *
     */
    private $requestFileName;

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

        if(!File::isDirectory(app_path('Http'.DIRECTORY_SEPARATOR.'Requests')))
        {
            File::makeDirectory(app_path('Http'.DIRECTORY_SEPARATOR.'Requests'),0777);
        }

        File::put(app_path('Http'.DIRECTORY_SEPARATOR.'Requests').DIRECTORY_SEPARATOR.$this->requestFileName,$this->requestTemplate);
        $this->output = $this->getClassName().' request file created';
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
        $this->requestTemplate = Str::of($this->getStub('request'))
            ->replace('{{ class }}', $this->getClassName())
            ->replace('{{ validation }}',$this->createFields(function($field){
                return "'$field[0]' => ['required',]";
            },','.PHP_EOL));
    }

    /**
     *
     */
    private function setFileName()
    {
        $this->requestFileName = $this->getClassName().'.php';
    }

    /**
     *
     */
    public function getClassName()
    {
        return Str::studly(self::$name).'Request';
    }
}
