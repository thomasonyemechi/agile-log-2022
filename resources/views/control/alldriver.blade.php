@extends('layouts/app')
@section('title')
    Control | All Driver
@endsection
@section('pagecontent')

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Drivers
                            <span class="fs-5 text-muted">( {{ \App\Models\User::where(['role' => 1])->count() }} )</span>
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Drivers
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <a href="/control/driver/add" class="btn btn-outline-white active">
                            <span class="fe fe-plus"></span> Add New Driver
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $users = \App\Models\User::where(['role' => 1])->orderBy('id', 'desc')->paginate(30);
            @endphp

            @foreach ($users as $user)

                <div class="col-lg-4 mb-3 col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/user/'.$user->img) }}" class="rounded-circle avatar-xl mb-3"
                                    alt="" />
                                <a href="/control/driver/profile/{{$user->id}}" ><h4 class="mb-0">{{ ucwords($user->name) }}</h4></a>
                                <p class="mb-0">{{ $user->email }}</p>
                            </div>



                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>Phone</span>
                                <span class="text-dark"> {{ $user->phone }} </span>
                            </div>

                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>Status</span>
                                @if ($user->status == 0)
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
                {{$users->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>

@endsection
