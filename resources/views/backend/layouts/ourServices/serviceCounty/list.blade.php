@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">All Counties</h1>
                <a href="{{ route('counties.create') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-plus"></i> Add New County
                </a>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped align-middle text-center">
                            <thead class="bg-teal text-white">
                            <tr>
                                <th>#</th>
                                <th>County Name</th>
                                <th>Country</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($counties as $county)
                                <tr>
                                    <td>{{ $loop->iteration + ($counties->currentPage()-1)*$counties->perPage() }}</td>
                                    <td>{{ $county->name }}</td>
                                    <td>{{ $county->country->name ?? '-' }}</td>
                                    <td>{{ $county->created_at ? $county->created_at->format('d M Y') : '-' }}</td>
                                    <td>
                                        <div style="display: flex; justify-content: center; gap: 8px;">
                                            <a href="{{ route('counties.edit', $county->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('counties.destroy', $county->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this county?')">
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
                                    <td colspan="5" class="text-center">No Counties Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $counties->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
