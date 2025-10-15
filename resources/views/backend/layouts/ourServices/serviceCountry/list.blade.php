@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0">All Countries</h1>
                <a href="{{ route('countries.create') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-plus"></i> Add New Country
                </a>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                {{-- Flash Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped align-middle text-center">
                            <thead class="bg-teal text-white">
                            <tr>
                                <th>#</th>
                                <th>Country Name</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($countries as $country)
                                <tr>
                                    <td>{{ $loop->iteration + ($countries->currentPage()-1)*$countries->perPage() }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->created_at ? $country->created_at->format('d M Y') : '-' }}</td>
                                    <td>
                                        <div style="display: flex; justify-content: center; gap: 8px;">
                                            <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('countries.destroy', $country->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this country?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Countries Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="mt-3 d-flex justify-content-end">
                            {{ $countries->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
