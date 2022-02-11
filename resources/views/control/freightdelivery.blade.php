@extends('layouts/app')
@section('title')
    Freight Delivery | {{ ucwords($freight->bill_number) }}
@endsection
@section('pagecontent')



    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Delivery Management: {{ $freight->bill_number }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/organization/{{$freight->manifest->org->slug}}">{{ ucwords($freight->manifest->org->name) }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/control/manifest/{{ $freight->manifest->id }}">{{ ucwords($freight->manifest->manifest_number) }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $freight->bill_number }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <a href="/control/freight/approval/{{$freight->id}}" class="btn  btn-outline-white active" >
                            <span class="fe fe-eye"></span> Approval Processes
                        </a>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Total</span>
                            </div>
                            <div>
                                <span class="text-primary total">{{ $stock =  \App\Models\FreightApproval::where('freight_id', $freight->id)->sum('pieces') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between  lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Assigned</span>
                            </div>
                            <div>
                                <span class="text-primary assigned">{{ $assigned = \App\Models\Delivery::where('freight_id', $freight->id)->sum('pieces') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Delivered</span>
                            </div>
                            <div>
                                <span class="text-success delivered">{{ \App\Models\Delivery::where(['freight_id' => $freight->id, 'status' => 1])->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-4 col-md-12 mb-3 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"> Assign Freight </h4>
                        @php
                            $disabled = '';
                        @endphp
                        @if($stock == 0) @php $disabled = 'disabled';  @endphp  <i class="mb-0 text-danger">Freight Has not approved</i> @endif
                    </div>
                    <div class="card-body" >
                        <form method="POST" action="{{ route('control.assignFreightToDriver') }}" class="row">@csrf
                            <x-jet-validation-errors />
                            <div class="mb-2 col-12">
                                <label class="form-label">Driver<span class="text-danger">*</span></label>
                                <select name="driver_id" class="form-select" {{$disabled}} >
                                    <option selected disabled>...Select Driver...</option>
                                    @foreach (\App\Models\User::where(['role' => 1 , 'status' => 1])->orderby('name', 'ASC')->get() as $driver)
                                        <option value="{{$driver->id}}">{{ucwords($driver->name)}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="freight_id" value="{{ $freight->id }}">
                            </div>
                            <div class="mb-2 col-12">
                                <label class="form-label">Pieces to Deliver<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" min="1" max="{{ $freight->pieces }}" name="pieces" value="{{ old('pieces') }}"
                                    placeholder="Pieces" {{$disabled}} required>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" {{$disabled}} class="btn btn-sm btn-primary" {{($assigned ==$freight->pieces) ? 'disabled' : '' ; }} >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-8 col-md-12 col-12">

                @php
                    $deliveries = \App\Models\Delivery::where('freight_id', $freight->id)->orderBy('id', 'desc')->paginate(50);
                @endphp
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="mb-0">Delivery Processes</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">Pieces</th>
                                    <th scope="col" class="border-0">Driver</th>
                                    <th scope="col" class="border-0">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deliveries as $del)

                                    <tr>
                                        <td>{{ $del->pieces }}  </td>
                                        <td>{{ ucwords($del->driver->name) }}</td>
                                        <td>{!! deliveryProStatus($del->status) !!}</td>
                                        <td> <button class="btn btn-xs btn-info">View Message</button> </td>
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





    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/littleAlert.js') }}"></script>
@endsection
