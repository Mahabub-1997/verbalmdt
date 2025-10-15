@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">

        <!-- Header Section -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Sponsors For Global Electrician Day-2026</h1>
                <div>
                    <a href="{{ route('dashboard') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter & Table Section -->
        <section class="content">
            <div class="container-fluid">

                <!-- Filter Form -->
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <form method="GET" class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                       placeholder="Search by name, company, email, phone, or licence...">
                            </div>

                            <div class="col-md-2">
                                <select name="per_page" class="form-select">
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Sponsor List</h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped table-bordered mb-0">
                            <thead class="bg-teal text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Parish</th>
                                <th>County</th>
                                <th>Zip Code</th>
                                <th>Licence Number</th>
                                <th>Licence Agency URL</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sponsors as $index => $item)
                                <tr class="text-center">
                                    <td>{{ $sponsors->firstItem() + $index }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->company_name ?? 'N/A' }}</td>
                                    <td>{{ $item->email ?? 'N/A' }}</td>
                                    <td>{{ $item->phone ?? 'N/A' }}</td>
                                    <td>{{ $item->country?->name ?? 'N/A' }}</td>
                                    <td>{{ $item->state ?? 'N/A' }}</td>
                                    <td>{{ $item->city ?? 'N/A' }}</td>
                                    <td>{{ $item->parish?->name ?? 'N/A' }}</td>
                                    <td>{{ $item->county?->name ?? 'N/A' }}</td>
                                    <td>{{ $item->zipCode?->code ?? 'N/A' }}</td>
                                    <td>{{ $item->licence_number ?? 'N/A' }}</td>
                                    <td>
                                        @if($item->licence_agency_url)
                                            <a href="{{ $item->licence_agency_url }}" target="_blank" title="Visit Licence Agency">
                                                Visit <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $item->message ?? 'N/A' }}</td>

                                    <!-- Status Column with Toggle Button -->
                                    <td>
                                        <form action="{{ route('sponsors.toggle-status', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm
                                            {{ $item->status === 'Active' ? 'btn-success' : 'btn-danger' }}">
                                                {{ $item->status ?? 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>

                                    <td>{{ $item->created_at->format('d M, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="16" class="text-center text-muted py-3">
                                        No sponsors found
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        {{ $sponsors->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
