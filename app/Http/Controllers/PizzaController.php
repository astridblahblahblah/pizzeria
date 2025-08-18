<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Enums\PizzaStatus;
use App\Jobs\NotifyPizzaStatusChange;

class PizzaController extends Controller
{
    /**
     * To keep things simple, we leave status updates here as this is the only item that can be updated anyway
     */
    public function update(Request $request, Pizza $pizza, string $status): Resource
    {
        $pizza->status = PizzaStatus::tryFrom($status);
        $pizza->save();

        NotifyPizzaStatusChange::dispatch($pizza);
    }
}
