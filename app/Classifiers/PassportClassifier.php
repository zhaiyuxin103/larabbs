<?php

namespace App\Classifiers;

use Sk\Passport\UserProvider;
use Wnx\LaravelStats\Contracts\Classifier;
use Wnx\LaravelStats\ReflectionClass;

class PassportClassifier implements Classifier
{
    public function name(): string
    {
        return 'Passport';
    }

    public function satisfies(ReflectionClass $class): bool
    {
        return $class->isSubclassOf(UserProvider::class);
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
