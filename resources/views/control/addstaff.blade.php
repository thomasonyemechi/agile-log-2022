@extends('layouts/app')
@section('title')
    Control | Add New Staff
@endsection
@section('pagecontent')

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Staffs Management
                            <span class="fs-5 text-muted">( {{ \App\Models\User::count() }} )</span>
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="admin-dashboard.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Staff Management
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <button type="button" class="btn btn-outline-white active"   data-bs-toggle="modal" data-bs-target="#addStaffModal">
                            <span class="fe fe-plus"></span> Add New Staff
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                @php
                    $users = \App\Models\User::orderBy('id', 'desc')->paginate(50);
                @endphp
                <!-- Tab -->
                <div class="tab-content">
                    <!-- Tab Pane -->
                    <div class="mb-4">
                        <input type="search" class="form-control" placeholder="Search Staff" />
                    </div>

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
                                                    {{-- <div class="position-relative">
                                                        <img src="../../assets/images/avatar/avatar-11.jpg" alt=""
                                                            class="rounded-circle avatar-md me-2" />
                                                        <a href="#" class="position-absolute mt-5 ms-n4">
                                                            <span class="status bg-success"></span>
                                                        </a>
                                                    </div> --}}
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
                                                        {{-- in active ... request activation --}}
                                                        <button class="btn btn-success btn-xs ">Acticate account</button>
                                                        @else
                                                        {{-- active .... request deactivation --}}
                                                        <button class="btn btn-xs btn-danger" >Deactivate account</button>
                                                    @endif

                                                    <button class="btn btn-info btn-xs ">See more</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex mt-3 justify-content-center">
                                {{$users->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStaffModal">Add New Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control.addStaff') }}" class="row">@csrf
                        <x-jet-validation-errors />
                        <div class="mb-2 col-12">
                            <label  class="form-label">Full Name</label>
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
                        <div class="col-12 mb-3">
                            <label class="form-label">Assign Role</label>
                            <select name="role_id" class="selectpicker" data-width="100%" required>
                                <option selected value=0>... Select Role ..</option>
                                <option value=1>Driver</option>
                                <option value=3>Normal Staff</option>
                                <option value=5>Administrator</option>
                            </select>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Staff</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
