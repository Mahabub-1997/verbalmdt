@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0">Add New Zip Code</h1>
                <a href="{{ route('zip_codes.index') }}" class="btn bg-gradient-teal btn-sm">
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
                        <form action="{{ route('zip_codes.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="code">Zip Code <span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="Enter zip code" value="{{ old('code') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="parish_id">Select Parish <span class="text-danger">*</span></label>
                                <select name="parish_id" class="form-control" required>
                                    <option value="">-- Choose Parish --</option>
                                    @foreach($parishes as $parish)
                                        <option value="{{ $parish->id }}" {{ old('parish_id') == $parish->id ? 'selected' : '' }}>
                                            {{ $parish->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn bg-gradient-teal">
                                <i class="fas fa-save"></i> Save Zip Code
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
