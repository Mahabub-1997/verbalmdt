@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0">Add New Annual Income</h1>
                <a href="{{ route('annual-incomes.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header bg-teal text-white">
                        <h5 class="mb-0">Add Annual Income Information</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('annual-incomes.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="annual_income">Annual Income <span class="text-danger">*</span></label>
                                <input type="text" name="annual_income" id="annual_income"
                                       class="form-control @error('annual_income') is-invalid @enderror"
                                       placeholder="Enter annual income range (e.g. 20,000 - 30,000)"
                                       value="{{ old('annual_income') }}" required>

                                @error('annual_income')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn bg-gradient-teal text-white">
                                    <i class="fas fa-save"></i> Save
                                </button>
                                <a href="{{ route('annual-incomes.index') }}" class="btn btn-secondary ml-2">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
