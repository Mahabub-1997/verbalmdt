@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Service Providers List</h1>
                <a href="{{ route('service-providers.create') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="bg-teal text-white">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Pricing Type</th>
                            <th>Company Name</th>
                            <th>Registration Number</th>
                            <th>Year of Establishment</th>
                            <th>Total Employees</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Description</th>
                            <th>Cover Photo</th>
                            <th>Logo</th>
                            <th>Amount</th>
                            <th>Country</th>
                            <th>County</th>
                            <th>Parish</th>
                            <th>Zip Code</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Upload Document</th>
                            <th>Experience Years</th>
                            <th>Licence Number</th>
                            <th>Licence Agency URL</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($providers as $provider)
                            <tr>
                                <td>{{ $provider->id }}</td>
                                <td>{{ $provider->user->name ?? '-' }}</td>
                                <td>{{ $provider->category->name ?? '-' }}</td>
                                <!-- Multiple Subcategories -->
                                <td>
                                    @if($provider->subcategory_ids && count($provider->subcategory_ids) > 0)
                                        <div style="display: flex; flex-wrap: wrap; gap: 5px;">
                                            @foreach(\App\Models\ServiceSubcategory::whereIn('id', $provider->subcategory_ids)->get() as $subcategory)
                                                <span style="border: 1px solid #ccc; padding: 3px 8px; border-radius: 5px; background-color: #f8f9fa; font-size: 13px;">
                                                      {{ $subcategory->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $provider->pricingType->name ?? '-' }}</td>
                                <td>{{ $provider->company_name }}</td>
                                <td>{{ $provider->registration_number ?? '-' }}</td>
                                <td>{{ $provider->year_of_establishment ?? '-' }}</td>
                                <td>{{ $provider->total_employees ?? '-' }}</td>
                                <td>{{ $provider->phone }}</td>
                                <td>{{ $provider->email ?? '-' }}</td>
                                <td>{{ $provider->description ?? '-' }}</td>

                                <!-- Cover Photo -->
                                <td>
                                    @if($provider->cover_photo)
                                        <a href="{{ asset('storage/'.$provider->cover_photo) }}" target="_blank">
                                            <img src="{{ asset('storage/'.$provider->cover_photo) }}"
                                                 alt="Cover Photo"
                                                 width="80" height="50"
                                                 style="object-fit: cover; border-radius: 5px;">
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Logo -->
                                <td>
                                    @if($provider->logo)
                                        <a href="{{ asset('storage/'.$provider->logo) }}" target="_blank">
                                            <img src="{{ asset('storage/'.$provider->logo) }}"
                                                 alt="Logo"
                                                 width="50" height="50"
                                                 style="object-fit: cover; border-radius: 50%;">
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ $provider->amount ?? '-' }}</td>
                                <td>{{ $provider->country->name ?? '-' }}</td>
                                <td>{{ $provider->county->name ?? '-' }}</td>
                                <td>{{ $provider->parish->name ?? '-' }}</td>
                                <td>{{ $provider->zipCode->code ?? '-' }}</td>
                                <td>{{ $provider->state ?? '-' }}</td>
                                <td>{{ $provider->city ?? '-' }}</td>
                                <td>{{ $provider->address ?? '-' }}</td>

                                <td>
                                    @if($provider->upload_document)
                                        <a href="{{ asset('storage/'.$provider->upload_document) }}" target="_blank">View</a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ $provider->experience_years ?? '-' }}</td>
                                <td>{{ $provider->licence_number ?? '-' }}</td>

                                <td>
                                    @if($provider->licence_agency_url)
                                        <a href="{{ $provider->licence_agency_url }}" target="_blank">Link</a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Actions (inline edit & delete) -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <a href="{{ route('service-providers.edit', $provider->id) }}" class="btn btn-sm btn-info me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('service-providers.destroy', $provider->id) }}" method="POST" class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="27" class="text-center">No service providers found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $providers->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
