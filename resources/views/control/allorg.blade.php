@extends('layouts/app')
@section('title')
    Control | All Companies
@endsection
@section('pagecontent')

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Companies
                            <span class="fs-5 text-muted">( {{ \App\Models\Organization::count() }} )</span>
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Companies
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <a href="/control/organization/new" class="btn btn-outline-white active">
                            <span class="fe fe-plus"></span> Add New Company
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $organizations = \App\Models\Organization::orderBy('id', 'desc')->paginate(30);
            @endphp

            @foreach ($organizations as $org)

                <div class="col-lg-3 mb-3 col-md-6 col-12">
                    <div class="card  ">
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

            <div class="d-flex justify-content-center">
                {{$organizations->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>

@endsection
