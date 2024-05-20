<?php

namespace App\Services\ProblemGenerators;

use App\Interfaces\ProblemGenerator;
use App\MathProblem;

class Division implements ProblemGenerator
{
    public function generateProblem(): MathProblem
    {
        $a = rand(1, 100);
        $b = rand(1, 100);
        $c = round($a / $b);
        $problem = "{$a} / {$b} = ?";

        return new MathProblem($problem, $c);
    }
}