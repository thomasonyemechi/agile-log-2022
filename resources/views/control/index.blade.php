@extends('layouts/app')
@section('title')
    Control | Dashboard
@endsection
@section('pagecontent')

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h1 class="mb-0 h2 fw-bold">Dashboard</h1>
                    </div>
                    {{-- <div class="d-flex">
                    <div class="input-group me-3  ">
                        <input class="form-control flatpickr" type="text" placeholder="Select Date" aria-describedby="basic-addon2">

                        <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                    </div>
                    <a href="#" class="btn btn-primary">Setting</a>
                </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Companies</span>
                            </div>
                            <div>
                                <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            {{\App\Models\Organization::count()}}
                        </h2>
                        <span class="text-success fw-semi-bold">{{\App\Models\User::count()}}</span>
                        <span class="ms-1 fw-medium">Total Users</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Freights</span>
                            </div>
                            <div>
                                <span class=" fe fe-book-open fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            {{\App\Models\Freight::count()}}
                        </h2>
                        <span class="text-success fw-semi-bold">{{\App\Models\Freight::where('status', '>', 0)->count()}}</span>
                        <span class="ms-1 fw-medium">Freights Approved</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Drivers</span>
                            </div>
                            <div>
                                <span class=" fe fe-user-check fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            {{\App\Models\User::where('role', 1)->count()}}
                        </h2>
                        <span class="text-success fw-semi-bold">{{\App\Models\Freight::where('status', 5)->count()}}</span>
                        <span class="ms-1 fw-medium">Deliveries</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Dock Box</span>
                            </div>
                            <div>
                                <span class=" fe fe-users fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            {{\App\Models\Freight::where('status', 0)->count()}}
                        </h2>
                        <span class="text-success fw-semi-bold">{{number_format(\App\Models\Freight::sum('weight'))}} LBS</span>
                        <span class="ms-1 fw-medium">Weight In</span>
                    </div>
                </div>
            </div>

        </div>




        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h4 class="mb-0 h2 fw-bold">Recent Companies</h4>
                    </div>
                    <div class="d-flex">
                    <a href="/control/organizations/all" class="btn btn-info"> <i class="fe fe-eye"></i> View All</a>
                    <a href="/control/organization/new " class="btn btn-primary ms-2"> <i class="fe fe-plus"></i> Add New</a>
                </div>
                </div>
            </div>


            @php
                $organizations = \App\Models\Organization::orderBy('id', 'desc')->limit(4)->get();
            @endphp

            @foreach ($organizations as $org)

                <div class="col-lg-3 mb-3 col-md-6 col-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/org/'.$org->logo) }}" class="rounded-circle avatar-xl mb-3"
                                    alt="" />
                                <a href="/control/organization/{{$org->slug}}" ><h4 class="mb-0">{{ ucwords($org->name) }}</h4></a>
                                <p class="mb-0">{{ $org->email }}</p>
                            </div>



                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>Phone</span>
                                <span class="text-dark"> {{ $org->phone }} </span>
                            </div>

                            <div class="d-flex justify-content-between py-2">
                                <span>Status</span>
                                @if ($org->status == 0)
                                    <div class="badge bg-danger">Inactive</div>
                                @else
                                    <div class="badge bg-success">Active</div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>



        <div class="row">

            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-4">
                <div class="card h-100">
                    <div
                        class="card-header d-flex align-items-center
                  justify-content-between card-header-height">
                        <h4 class="mb-0">Recently Added Freights</h4>
                        <a href="/control/all/freight" class="btn btn-outline-white btn-sm">View all</a>
                    </div>
                    @php
                    $freights = \App\Models\Freight::orderBy('id', 'desc')->limit(10)->get();
                    @endphp

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="border-0"> Pro</th>
                                        <th scope="col" class="border-0">Others </th>
                                        <th scope="col" class="border-0">DESTINATION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($freights as $fre)
                                    <tr>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="freightInfo align-middle" style="font-weight: bolder"
                                                title="click for more">{{$fre->pro }} {!! deliveryProStatus($fre->status) !!} </a>
                                        </td>
                                        <td class="align-middle"> {{$fre->weight}} LBS | {{ money($fre->byd_split) }}</td>
                                        <td class="align-middle">{{ $fre->destination }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>



@endsection
