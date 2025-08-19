<?php

namespace App\Models\Enums;

enum PizzaStatus: string
{
    case Prepping = 'Prepping';
    case Baking = 'Baking';
    case Done = 'Done';

    /**
     * Allowed status transitions
     *
     * @return array<PizzaStatus>
     */
    public function transitions(): array
    {
        return match ($this) {
            self::Prepping => [self::Baking],
            self::Baking => [self::Done],
            self::Done => [],
            default => [self::Prepping],
        };
    }
}
