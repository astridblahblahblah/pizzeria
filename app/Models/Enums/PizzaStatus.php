<?php

namespace App\Models\Enums;

enum PizzaStatus
{
    case Prepping;
    case Baking;
    case Done;

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
            default => [],
        };
    }
}
