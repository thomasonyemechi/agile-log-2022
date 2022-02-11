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
                            {{ ucwords($driver->name) }} ({{ UserRole($driver->role) }})
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/driver/all">All Drivers</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ ucwords($driver->name) }} Profile
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <a href="/control/driver/add" class="btn btn-outline-white active">
                            <span class="fe fe-edit"></span> Edit {{ ucwords($driver->name) }} Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-3 col-md-12 col-12">
                <div class="card ">
                    <div class="card-body pb-0">
                        <div class="text-center">
                            <img src="{{ asset('assets/img/user/' . $driver->img) }}" class="rounded-circle avatar-xl mb-3"
                                alt="" />
                            <a href="/control/driver/{{ $driver->id }}">
                                <h4 class="mb-0">{{ ucwords($driver->name) }}</h4>
                            </a>
                            <p class="mb-0">{{ $driver->email }}</p>
                        </div>
                        <div class="d-flex justify-content-between  border-bottom py-2">
                            <span>Phone</span>
                            <span class="text-dark"> {{ $driver->phone }} </span>
                        </div>

                        <div class="d-flex justify-content-between py-2">
                            <span>Status</span>
                            @if ($driver->status == 0)
                                <div class="badge bg-danger">Inactive</div>
                            @else
                                <div class="badge bg-success">Active</div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between pb-0 mb-0">
                            <div>
                                <h4 class="mb-0 fw-bold">{{ \App\Models\Freight::where(['driver_id' => $driver->id, ])->sum('pallet') }}</h4>
                                <p class="fs-6 mb-0">Pallets assigned</p>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ \App\Models\Freight::where(['driver_id' => $driver->id, 'status' => 5 ])->sum('pallet') }}</h4>
                                <p class="fs-6 mb-0">Pallet Delivered</p>
                            </div>
                        </div>

                    </div>
                </div>



            </div>

            <div class="col-lg-8 col-md-12 col-12">
                @php
                    $deliveries = \App\Models\Freight::where('driver_id', $driver->id)->orderBy('id', 'desc')->paginate(50);
                @endphp
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="mb-0">Assigned Freight</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">PRO</th>
                                        <th scope="col" class="border-0">Pallet</th>
                                        <th scope="col" class="border-0">Cosignee</th>
                                        <th scope="col" class="border-0">Destination</th>
                                        <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deliveries as $del)
                                    <tr>
                                        <td class="align-middle"> {{$del->pro}} </td>
                                        <td class="align-middle"> {{$del->pallet}}  {!! deliveryProStatus($del->status) !!}  </td>
                                        <td class="align-middle">{{ $del->consignee }}</td>
                                        <td class="align-middle"> {{$del->destination}} </td>
                                        <td class="align-middle"> <button class="btn btn-xs btn-info">See Messages</button> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        {{ $deliveries->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
