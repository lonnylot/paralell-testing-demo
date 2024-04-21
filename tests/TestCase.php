<?php

namespace Tests;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function createApplication()
    {
        $app = parent::createApplication();

        ParallelTesting::resolveOptionsUsing(function ($option) {
            if ($option === 'connections') {
                return [ 'mysql', 'pgsql' ];
            }
        
            $option = 'LARAVEL_PARALLEL_TESTING_'.Str::upper($option);
        
            return $_SERVER[$option] ?? false;
        });
        
        return $app;
    }
}
