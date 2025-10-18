@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Add Service Provider</h1>
                <a href="{{ route('service-providers.index') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-list"></i> Back to List
                </a>
            </div>
        </div>

        <section class="content">
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

                <form action="{{ route('service-providers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card p-3">
                        <div class="row">

                            <!-- User -->
                            <div class="col-md-4 mb-3">
                                <label>User <span class="text-danger">*</span></label>
                                <select name="user_id" class="form-control" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Category -->
                            <div class="col-md-4 mb-3">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Company Info -->
                            <div class="col-md-4 mb-3">
                                <label>Company Name</label>
                                <input type="text" name="company_name" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Registration Number</label>
                                <input type="text" name="registration_number" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Year of Establishment</label>
                                <input type="number" name="year_of_establishment" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Total Employees</label>
                                <input type="number" name="total_employees" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Amount</label>
                                <input type="number" name="amount" class="form-control" step="0.01" placeholder="Enter amount">
                            </div>

                            <!-- Description -->
                            <div class="col-md-12 mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>

                            <!-- File Uploads -->
                            <div class="col-md-4 mb-3">
                                <label>Cover Photo</label>
                                <input type="file" name="cover_photo" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Upload Document</label>
                                <input type="file" name="upload_document" class="form-control">
                            </div>

                            <!-- Location Info -->
                            <div class="col-md-4 mb-3">
                                <label>Country</label>
                                <select name="country_id" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>County</label>
                                <select name="county_id" class="form-control">
                                    <option value="">Select County</option>
                                    @foreach($counties as $county)
                                        <option value="{{ $county->id }}">{{ $county->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Pricing Type -->
                            <div class="col-md-4 mb-3">
                                <label>Pricing Type</label>
                                <select name="pricing_type_id" class="form-control">
                                    <option value="">Select Pricing Type</option>
                                    @foreach($pricingTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Parish</label>
                                <select name="parish_id" class="form-control">
                                    <option value="">Select Parish</option>
                                    @foreach($parishes as $parish)
                                        <option value="{{ $parish->id }}">{{ $parish->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Zip Code</label>
                                <select name="zip_code_id" class="form-control">
                                    <option value="">Select Zip</option>
                                    @foreach($zipCodes as $zip)
                                        <option value="{{ $zip->id }}">{{ $zip->code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>State</label>
                                <input type="text" name="state" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>City</label>
                                <input type="text" name="city" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="2"></textarea>
                            </div>

                            <!-- Other Info -->
                            <div class="col-md-4 mb-3">
                                <label>Experience Years</label>
                                <input type="number" name="experience_years" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Licence Number</label>
                                <input type="text" name="licence_number" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Licence Agency URL</label>
                                <input type="url" name="licence_agency_url" class="form-control">
                            </div>

                            <!-- Multiple Services Section -->
                            <div class="col-md-12 mb-3">
                                <label>Subcategories</label>
                                <div id="subcategories-wrapper">
                                    <div class="d-flex mb-2 subcategory-row">
                                        <select name="subcategories[]" class="form-control me-2" required>
                                            <option value="">Select Subcategory</option>
                                            @foreach($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-success add-subcategory">+</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn bg-gradient-teal text-white px-4">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    {{-- JS for dynamic service rows --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('subcategories-wrapper');

            wrapper.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('add-subcategory')) {
                    const newRow = e.target.closest('.subcategory-row').cloneNode(true);
                    newRow.querySelector('select').value = ''; // reset select
                    wrapper.appendChild(newRow);
                }
            });
        });
    </script>
@endsection
