<?php

namespace App\Classifiers;

use App\Repositories\Repository;
use Wnx\LaravelStats\Contracts\Classifier;
use Wnx\LaravelStats\ReflectionClass;

class RepositoryClassifier implements Classifier
{
    public function name(): string
    {
        return 'Repositories';
    }

    public function satisfies(ReflectionClass $class): bool
    {
        return $class->isSubclassOf(Repository::class);
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
