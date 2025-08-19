<?php

use App\Http\Controllers\PizzaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas.index');
Route::get('/pizzas/{pizza}', [PizzaController::class, 'show'])->name('pizzas.show');
Route::put('/pizzas/{pizza}', [PizzaController::class, 'update'])->name('pizzas.update');
