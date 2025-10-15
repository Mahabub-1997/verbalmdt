@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0">Add New Country</h1>
                <a href="{{ route('countries.index') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
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
                        <form action="{{ route('countries.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name">Country Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control"
                                       placeholder="Enter country name" value="{{ old('name') }}" required>
                            </div>

                            <button type="submit" class="btn bg-gradient-teal">
                                <i class="fas fa-save"></i> Save Country
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
