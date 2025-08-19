<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePizzaRequest;
use App\Models\Pizza;
use App\Models\Enums\PizzaStatus;
use App\Jobs\NotifyPizzaStatusChange;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class PizzaController
{
    /**
     * Show a list of pizzas
     */
    public function index(): JsonResource
    {
        return JsonResource::collection(Pizza::all());
    }

    /**
     * Show a pizza
     */
    public function show(Pizza $pizza): JsonResource
    {
        $resource = $pizza->toArray();
        $resource['status_transitions'] = $pizza->status->transitions();
        return new JsonResource($resource);
    }

    /**
     * Handle the update
     *
     * @param UpdatePizzaRequest $request
     * @param Pizza $pizza
     * @return RedirectResponse
     */
    public function update(UpdatePizzaRequest $request, Pizza $pizza): JsonResource
    {
        $pizza->update($request->validated());

        NotifyPizzaStatusChange::dispatch($pizza);

        return new JsonResource($pizza->refresh());
    }
}
