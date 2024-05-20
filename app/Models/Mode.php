<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    use HasFactory;

    public function defaultValue(): int
    {
        return key($this->values());
    }

    public function values(): array
    {
        if ($this->name === 'time') {
            return $this->getTimeModes();
        }

        return $this->getQuantityModes();
    }

    public function getTimeModes(): array
    {
        return [
            '15' => '15 sec',
            '30' => '30 sec',
            '60' => '1 minute',
            '120' => '2 minutes',
        ];
    }

    public function getQuantityModes(): array
    {
        return [
            '3' => '3',
            '5' => '5',
            '10' => '10',
            '25' => '25',
            '50' => '50',
        ];
    }
}
