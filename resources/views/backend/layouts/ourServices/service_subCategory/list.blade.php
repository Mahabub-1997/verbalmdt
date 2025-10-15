@extends('backend.partials.master') {{-- Your master layout --}}

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">All Service Sub-Categories</h1>
                <a href="{{ route('service-subcategories.create') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-plus"></i> Add New Sub-Category
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
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $loop->iteration + ($subcategories->currentPage()-1)*$subcategories->perPage() }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->slug }}</td>
                                    <td>{{ $subcategory->category->name ?? '-' }}</td>
                                    <td>{{ ($subcategory->description) }}</td>
                                    <td>
                                        <div style="display: flex; justify-content: center; gap: 8px;">

                                            <a href="{{ route('service-subcategories.edit', $subcategory->id) }}"
                                               class="btn btn-sm btn-info"><i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('service-subcategories.destroy', $subcategory->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this?')">
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
                                    <td colspan="6" class="text-center">No Subcategories Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $subcategories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
