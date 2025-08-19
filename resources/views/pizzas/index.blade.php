@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Pizza List</h1>

@if(session('success'))
    <div class="alert alert-success shadow-lg mb-6">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                 fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

<div class="overflow-x-auto">
    <table class="table table-zebra w-full">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pizzas as $pizza)
                <tr>
                    <td>{{ $pizza->name }}</td>
                    <td>{{ ucfirst($pizza->status->value) }}</td>
                    <td>
                        @if(!empty($pizza->status->transitions()))
                            <a href="{{ route('pizzas.edit', $pizza) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
