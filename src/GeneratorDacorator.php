<?php

namespace ION\Crud;

use Illuminate\Support\Facades\File;

abstract class GeneratorDacorator extends Bootstrapper implements GeneratorInterface
{
    /**
     * @var GeneratorInterface
     */
    protected $command;

    /**
     * @var array
     */
    protected static $generated = [];

    /**
     * it concatenate the dacorator
     *
     * @param GeneratorInterface $command
     */
    public function __construct(GeneratorInterface $command)
    {
        $this->command = $command;

        $this->setAsGenerated($this);
    }

    /**
     * getting stub file.
     *
     * @param string $type
     * @return string
     */
    protected function getStub(string $type)
    {
        return File::get(__DIR__.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.$type.'.stub');
    }

    /**
     * getting the file
     *
     * @param callable $callback
     * @param string $implodeBy
     *
     * @return string
     */
    protected function createFields(callable $callback, string $implodeBy)
    {
        return self::$fields->map($callback)->implode($implodeBy);
    }

    /**
     * setting every class is generated
     *
     * @param GeneratorInterface $generator
     * @return void
     */
    public function setAsGenerated(GeneratorInterface $generator)
    {
        self::$generated[] = $generator;
    }

    /**
     * getting all generated classes.
     *
     * @return array
     */
    public function getWhatGenerated()
    {
        return self::$generated;
    }

    /**
     * determine if the generator has been called
     *
     * @param string $type
     * @return bool
     */
    public function isGenerated(string $type) : bool
    {
        foreach(self::$generated as $generator){
            if(get_class($generator) == $type)
            {
                $this->classGenerated = $generator;
                return true;
            }
        }
        return false;
    }

    /**
     * gettring the last generate from IsGenerated
     *
     * @return GeneratorInterface
     */
    public function getHisClassName()
    {
        return $this->classGenerated->getClassName();
    }

    /**
     * generate all regestired generators
     *
     * @return void
     */
    public function exec()
    {
        foreach(self::$generated as $generator)
        {
            $generator->generate();
        }
    }

    /**
     * string tells what have beed generated
     *
     * @return string
     */
    public function whatDidYouDo()
    {
        $output = '';
        foreach(self::$generated as $generator)
        {
            $output .= $generator->output().PHP_EOL;
        }
        return $output.PHP_EOL.(new Generator)->output();
    }
}
