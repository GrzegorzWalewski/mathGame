<?php

namespace App\Services;

use App\Interfaces\ProblemGenerator as ProblemGeneratorInterface;
use App\Services\ProblemGenerators\Addition;
use App\Services\ProblemGenerators\Division;
use App\Services\ProblemGenerators\Multiplication;
use App\Services\ProblemGenerators\Subtraction;
use App\MathProblem;

class ProblemGenerator implements ProblemGeneratorInterface
{
    private ProblemGeneratorInterface $problemGenerator;

    public function __construct($gameType)
    {
        $this->problemGenerator = match ($gameType) {
            1 => new Addition(),
            2 => new Subtraction(),
            3 => new Multiplication(),
            4 => new Division(),
            default => throw new \Exception('Invalid game type')
        };
    }

    public function generateProblem(): MathProblem
    {
        return $this->problemGenerator->generateProblem();
    }
}