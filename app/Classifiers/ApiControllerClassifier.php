<?php

namespace App\Classifiers;

use App\Http\Controllers\Api\Controller;
use Wnx\LaravelStats\Contracts\Classifier;
use Wnx\LaravelStats\ReflectionClass;

class ApiControllerClassifier implements Classifier
{
    public function name(): string
    {
        return 'ApiController';
    }

    public function satisfies(ReflectionClass $class): bool
    {
        return $class->isSubclassOf(Controller::class);
    }

    public function countsTowardsApplicationCode(): bool
    {
        return true;
    }

    public function countsTowardsTests(): bool
    {
        return false;
    }
}
