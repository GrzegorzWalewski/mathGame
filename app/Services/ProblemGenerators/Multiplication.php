<?php

namespace App\Services\ProblemGenerators;

use App\Interfaces\ProblemGenerator;
use App\MathProblem;

class Multiplication implements ProblemGenerator
{
    public function generateProblem(): MathProblem
    {
        $a = rand(1, 100);
        $b = rand(1, 100);
        $c = $a * $b;
        $problem = "{$a} * {$b} = ?";

        return new MathProblem($problem, $c);
    }
}