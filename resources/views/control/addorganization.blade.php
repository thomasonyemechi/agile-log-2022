@extends('layouts/app')
@section('title')
    Control | Create Company
@endsection
@section('pagecontent')

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Create Company
                            <span class="fs-5 text-muted">( {{ \App\Models\Organization::count() }} )</span>
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="admin-dashboard.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Create Company
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <a href="/control/organizations/all" class="btn btn-outline-white active">
                            <span class="fe fe-eye"></span> View All Company
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">


                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Add Company</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('control.createOrganization') }}" method="POST" enctype="multipart/form-data" class="row">@csrf
                            <x-jet-validation-errors />
                            <div class="mb-2 col-6">
                                <div class="mb-2">
                                    <label  class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"  value="{{ old('name') }}" placeholder="Organization name" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label"> Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address" >
                                </div>

                                <div class="mb-2">
                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"  placeholder="Enter phone" required>
                                </div>


                                <div class="mb-2">
                                    <label class="form-label">Address </label>
                                    <textarea name="address" class="form-control" rows="2" placeholder="Address" > {{ old('address') }}</textarea>
                                </div>


                            </div>
                            <div class="mb-2 col-6">
                                <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                                    <label class="form-label">Company Logo
                                        <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="logo" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                                </small>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                @php
                    $organizations = \App\Models\Organization::orderBy('id', 'desc')->limit(50)->get();
                @endphp
                <!-- Tab -->
                <div class="card mt-3">
                    <div class="table-responsive">
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">Name</th>
                                    <th scope="col" class="border-0">E-mail</th>
                                    <th scope="col" class="border-0">Phone</th>
                                    <th scope="col" class="border-0">Status</th>
                                    <th scope="col" class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organizations as $org)
                                    <tr>
                                        <td class="align-middle border-top-0">
                                            <div class="d-flex align-items-center">
                                                <div class="position-relative">
                                                    <img src="{{ asset('assets/img/org/'.$org->logo) }}" alt=""
                                                        class="rounded-circle avatar-md me-2" />
                                                    <a href="#" class="position-absolute mt-5 ms-n4">
                                                        <span class="status bg-success"></span>
                                                    </a>
                                                </div>
                                                <h5 class="mb-0" style="font-weight: bolder"> {{ucwords($org->name)}} </h5>
                                            </div>
                                        </td>
                                        <td class="align-middle border-top-0">
                                            {{ $org->email }}
                                        </td>
                                        <td class="align-middle border-top-0">
                                            {{$org->phone}}
                                        </td>
                                        <td class="align-middle border-top-0">
                                            @if ($org->status == 0)
                                                <div class="badge bg-danger">Inactive</div>
                                                @else
                                                <div class="badge bg-success">Active</div>
                                            @endif

                                        </td>
                                        <td class="align-middle border-top-0">
                                            <a href="/control/organization/{{$org->slug}}" class="btn btn-info btn-xs ">See more</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
