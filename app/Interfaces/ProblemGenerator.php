<?php

namespace App\Interfaces;
use App\MathProblem;

interface ProblemGenerator
{
    public function generateProblem(): MathProblem;
}