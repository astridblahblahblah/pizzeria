@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(!empty($pizza->status->transitions()))
        <h1 class="text-3xl font-bold mb-6">Edit Pizza</h1>

        <form action="{{ route('pizzas.update', $pizza) }}" method="POST"
              class="card bg-base-100 shadow-xl p-8 mb-6 max-w-2xl mx-auto">
            @csrf
            @method('PUT')

            {{-- Pizza Name --}}
            <div class="mb-4">
                <h2 class="text-2xl font-bold mb-2">{{ $pizza->name }}</h2>
            </div>

            {{-- Status Select --}}
            <div class="form-control mb-4">
                <label class="label px-2" for="status">
                    <span class="label-text">Status</span>
                </label>
                <select name="status" id="status" class="select select-bordered" required>
                    @foreach($pizza->status->transitions() as $status)
                        <option value="{{ $status->value }}" {{ old('status', $pizza->status->value) === $status->value ? 'selected' : '' }}>
                            {{ ucfirst($status->value) }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>
        </form>
    @else
        <h1 class="text-3xl font-bold mb-6">Pizza is done!</h1>
        <a href="{{ route('pizzas.index') }}" class="btn btn-primary">
            Update Other Pizzas
        </a>
    @endif
@endsection
