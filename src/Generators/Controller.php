<?php

namespace ION\Crud\Generators;

use Illuminate\Support\Facades\File;
use ION\Crud\GeneratorDacorator;
use Illuminate\Support\Str;

class Controller extends GeneratorDacorator
{
    /**
     *
     */
    private $controllerTemplate;

    /**
     *
     */
    private $controllerFileName;

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

        File::put(app_path('Http'.DIRECTORY_SEPARATOR.'Controllers').DIRECTORY_SEPARATOR.$this->controllerFileName,$this->controllerTemplate);
        File::append(base_path('routes/api.php'), 'Route::apiResource(\'' . self::$name . "', '\App\Http\Controllers\\".$this->getClassName()."');".PHP_EOL);
        $this->output = $this->getClassName().' controller file created'.PHP_EOL.self::$name.' api routes created';
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
        $this->controllerTemplate = Str::of($this->getStub('controller'))
            ->replace('{{ class }}', $this->getClassName());

            // dd($this->isGenerated("ION\Crud\Generators\Request"));
        if($this->isGenerated("ION\Crud\Generators\Request")){
            $this->controllerTemplate = $this->controllerTemplate->replace('{{ request_class }}', $this->getHisClassName());
        }

        if($this->isGenerated("ION\Crud\Generators\Model")){
            $this->controllerTemplate = $this->controllerTemplate->replace('{{ model_class }}', $this->getHisClassName())
                ->replace('{{ model_var }}', Str::lower($this->getHisClassName()));
        }

        if($this->isGenerated("ION\Crud\Generators\Resource")){
            $this->controllerTemplate = $this->controllerTemplate->replace('{{ resource_class }}', $this->getHisClassName());
        }
    }

    /**
     *
     */
    private function setFileName()
    {
        $this->controllerFileName = $this->getClassName().'.php';
    }

    /**
     *
     */
    public function getClassName()
    {
        return Str::studly(self::$name).'Controller';
    }
}
