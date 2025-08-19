<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePizzaRequest;
use App\Models\Pizza;
use App\Models\Enums\PizzaStatus;
use App\Jobs\NotifyPizzaStatusChange;
use Illuminate\Http\RedirectResponse;

class PizzaController
{

    /**
     * Show a list of pizzas
     */
    public function index()
    {
        $pizzas = Pizza::all();
        return view('pizzas.index', compact('pizzas'));
    }

    /**
     * Show the update form
     *
     * @param Pizza $pizza
     */
    public function edit(Pizza $pizza)
    {
        return view('pizzas.edit', compact('pizza'));
    }

    /**
     * Handle the update
     *
     * @param UpdatePizzaRequest $request
     * @param Pizza $pizza
     * @return RedirectResponse
     */
    public function update(UpdatePizzaRequest $request, Pizza $pizza): RedirectResponse
    {
        $pizza->update($request->validated());

        NotifyPizzaStatusChange::dispatch($pizza);

        return redirect()->route('pizzas.edit', $pizza)->with('success', 'Pizza updated successfully!');
    }
}
