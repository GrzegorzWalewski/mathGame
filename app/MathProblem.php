<?php

namespace App;
use Livewire\Wireable;

class MathProblem implements Wireable
{
    public string $problem;
    public float $answer;

    public function __construct(string $problem, float $answer) 
    {
        $this->problem = $problem;
        $this->answer = $answer;
    }

    public function toLivewire(): array
    {
        return [
            'problem' => $this->problem,
            'answer' => $this->answer,
        ];
    }
 
    public static function fromLivewire($value): static
    {
        $problem = $value['problem'];
        $answer = $value['answer'];
 
        return new static($problem, $answer);
    }
}