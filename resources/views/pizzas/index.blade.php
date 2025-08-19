@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Pizza List</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white shadow-md rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pizzas as $pizza)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $pizza->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $pizza->status->value }}</td>
                    <td class="py-2 px-4 border-b">
                        @if (!empty($pizza->status->transitions()))
                        <a href="{{ route('pizzas.edit', $pizza) }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                           Edit
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
