@extends('layouts.app')

@section('content')
    @if(!empty($pizza->status->transitions()))
    <h1 class="text-2xl font-bold mb-6">Edit Pizza</h1>

    <!-- Your form here -->
    <form action="{{ route('pizzas.update', $pizza) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <h4 class="text-2xl font-bold mb-6">{{ $pizza->name }}</h1>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status</label>
            <select name="status" id="status"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach($pizza->status->transitions() as $status)
                    <option value="{{ $status->value }}" {{ old('status', $pizza->status->value) === $status->value ? 'selected' : '' }}>
                        {{ $status->value }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update
            </button>
        </div>
    </form>
    @else
        <h1 class="text-2xl font-bold mb-6">Pizza is done!</h1>
        <a href="{{ route('pizzas.index') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
           Update other pizzas
        </a>
    @endif
@endsection
