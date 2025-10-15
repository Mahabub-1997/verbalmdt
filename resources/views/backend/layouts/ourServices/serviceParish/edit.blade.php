@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0">Edit Parish</h1>
                <a href="{{ route('parishes.index') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('parishes.update', $parish->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name">Parish Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $parish->name) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="county_id">Select County <span class="text-danger">*</span></label>
                                <select name="county_id" class="form-control" required>
                                    <option value="">-- Choose County --</option>
                                    @foreach($counties as $county)
                                        <option value="{{ $county->id }}" {{ old('county_id', $parish->county_id) == $county->id ? 'selected' : '' }}>
                                            {{ $county->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn bg-gradient-teal">
                                <i class="fas fa-sync-alt"></i> Update Parish
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
