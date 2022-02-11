@extends('layouts/app')
@section('title')
    Control | Add New Driver
@endsection
@section('pagecontent')

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Driver Management
                            <span class="fs-5 text-muted">( {{ \App\Models\User::where(['role' => 1])->count() }} )</span>
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Driver Management
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <a href="/control/driver/all" class="btn btn-outline-white active">
                            <span class="fe fe-eye"></span> View All Drivers
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-3 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Add New Driver</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('control.addStaff') }}" class="row">@csrf
                            <x-jet-validation-errors />
                            <div class="mb-2 col-12">
                                <label  class="form-label">Full Name</label>
                                <input type="hidden" name="role" value="1">
                                <input type="text" class="form-control" name="name"  value="{{ old('name') }}" placeholder="Enter full name" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address" required>
                            </div>
                            <div class="mb-2 col-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"  placeholder="enter phone" required>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Add Staff</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12">
                @php
                    $users = \App\Models\User::where(['role' => 1])->orderBy('id', 'desc')->limit(25)->get();
                @endphp
                <!-- Tab -->
                <div class="tab-content">

                    <div class="card">
                        <div class="table-responsive">
                            <table class="table mb-0 text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="border-0">Name</th>
                                        <th scope="col" class="border-0">Role</th>
                                        <th scope="col" class="border-0">E-mail</th>
                                        <th scope="col" class="border-0">Phone</th>
                                        <th scope="col" class="border-0">Status</th>
                                        <th scope="col" class="border-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="align-middle border-top-0">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="mb-0"> {{ucwords($user->name)}} </h5>
                                                </div>
                                            </td>
                                            <td class="align-middle border-top-0">
                                                {{ userRole($user->role) }}
                                            </td>
                                            <td class="align-middle border-top-0">
                                                {{$user->email}}
                                            </td>
                                            <td class="align-middle border-top-0">{{$user->phone}}</td>
                                            <td class="align-middle border-top-0">
                                                @if ($user->status == 0)
                                                    <div class="badge bg-danger">Inactive</div>
                                                    @else
                                                    <div class="badge bg-success">Active</div>
                                                @endif

                                            </td>
                                            <td class="align-middle border-top-0">
                                                <form action="{{ route('control.userStatus') }}" method="POST" >@csrf
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    @if ($user->status == 0)
                                                        <button class="btn btn-success btn-xs ">Acticate account</button>
                                                        @else
                                                        <button class="btn btn-xs btn-danger" >Deactivate account</button>
                                                    @endif
                                                    <a href="/control/driver/profile/{{ $user->id }}" class="btn btn-info btn-xs ">Profile</button>
                                                </form>
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
    </div>

@endsection
