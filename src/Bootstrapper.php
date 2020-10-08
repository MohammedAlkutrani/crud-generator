<?php

namespace ION\Crud;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class Bootstrapper
{
    /**
     * @var string
     *
     * holds the name of the CRUD resources
     */
    protected static $name;

    /**
     * @var Collection
     *
     * holds the fields that would be generated
     */
    protected static $fields = [];

    /**
     * the name of the CRUD resources setter
     *
     * @param string $name
     * @return \ION\Crud\Bootstrapper
     */
    public function setName(string $name) : Bootstrapper
    {
        self::$name = $name;
        return $this;
    }

    /**
     * the name getter
     *
     * @return string
     */
    public function getName() : string
    {
        return self::$name;
    }

    /**
     * the fields setter
     *
     * @param string $fields
     * @return \ION\Crud\Bootstrapper
     */
    public function setFields(string $fields) : Bootstrapper
    {
        self::$fields = Str::of($fields)
            ->explode(',')
            ->map(function($field){
                return Str::of($field)->explode(':');
            });
        return $this;
    }

    /**
     * the fields getter
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFields() : Collection
    {
        return self::$fields;
    }
}
