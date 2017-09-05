<?php namespace App\Rinekso\Example;

use App\Rinekso\BaseRepo;

class ExampleRepo extends BaseRepo
{
    public function __construct(Example $example)
    {
        $this->model = $example;
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:03
 */