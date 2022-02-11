@extends('layouts/app')
@section('title')
    Freight Approval | {{ ucwords($freight->bill_number) }}
@endsection
@section('pagecontent')

    <style>
        .f-img {
            width: 100%;
            height: 120px;
        }

        .f-cover {
            object-fit: cover;
        }

    </style>
    @php
    $stock = \App\Models\FreightApproval::where('freight_id', $freight->id)->sum('pieces');
    $disabled = '';
    if($freight->status > 2){ $disabled = 'disabled'; }
    @endphp



    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Approval Management: {{ $freight->bill_number }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a
                                        href="/control/organization/{{ $freight->manifest->org->slug }}">{{ ucwords($freight->manifest->org->name) }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a
                                        href="/control/manifest/{{ $freight->manifest->id }}">{{ ucwords($freight->manifest->manifest_number) }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $freight->bill_number }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <button class="btn  btn-outline-white active" data-bs-toggle="modal" data-bs-target="#assignFreight" >
                            <span class="fe fe-arrow"></span> Assign To Driver
                        </button>
                    </div>
                </div>

                <div class="row">
                    @if ($freight->status > 2)
                        <div class="col-12">
                            @if ($freight->status == 3)
                                <div class="alert text-center text-white bg-primary">
                                    This freight has been assigned to {{ucwords($freight->driver->name)}}  for delivery
                                </div>
                            @elseif ($freight->status == 4)
                                <div class="alert text-center text-white bg-secondary">
                                    This freight is out for delivery by {{ucwords($freight->driver->name)}}
                                </div>
                            @elseif ($freight->status == 5)
                                <div class="alert text-center text-white bg-success">
                                    This freight has been sucessfully delivered by {{ucwords($freight->driver->name)}}
                                </div>
                            @elseif ($freight->status == 6)
                                <div class="alert text-center text-white bg-danger">
                                    This freight is refused from {{ucwords($freight->driver->name)}}
                                </div>
                            @endif

                        </div>
                    @endif
                    <div class="col-md-12 col-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Consignee Name</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->consignee }} </p>
                                    </div>

                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Consignee Email</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->consignee_email }} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Consignee Phone</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->consignee_phone }} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Consignee Address</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->consignee_address }} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Shipper</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->shipper }} </p>
                                    </div>

                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Destination</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->destination }} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Weight</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->weight }} LBS </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Byd Split</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->byd_split }} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Protective Service</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->consignee_address }} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Due Date</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->due_date }} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Pieces</h5>
                                        <p class="fs-6 mb-0"> {{ $freight->pieces }} </p>
                                    </div>

                                    <div class="col-md-2 col-4">
                                        {!! appointment($freight->need_appointment) !!}
                                    </div>


                                    <div class="col-md-12 col-12 d-flex justify-content-end ">
                                        <button class="btn btn-primary btn-xs " data-bs-toggle="modal"
                                            data-bs-target="#editFreight"><i class="fe fe-edit"></i> Edit Freight Info
                                        </button>
                                    </div>
                                </div>
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
                        <h4 class="mb-0"> Make an Approval </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('control.approveFreight') }}" enctype="multipart/form-data"
                            class="row">@csrf
                            <x-jet-validation-errors />
                            <div class="mb-2 col-md-12">
                                <label class="form-label">Pallets Received <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="pallet_in" value="{{ old('pallet_in') }}"
                                    placeholder="Pallets Received" required>
                                <input type="hidden" name="freight_id" value="{{ $freight->id }}">
                            </div>

                            <div class="mb-2 col-md-12">
                                <label class="form-label">Photos</label>
                                <input type="file" class="form-control" name="photos[]" multiple
                                    accept="image/png, image/gif, image/jpeg">
                            </div>

                            <div class="mb-2 col-12">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="2"
                                    placeholder="Enter message concerning this freight here"></textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary  " {{$disabled}} >Approve Freight</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>



            <div class="col-lg-8 col-md-12 col-12">
                @php
                    $photos = [];
                    $approvals = \App\Models\FreightApproval::where('freight_id', $freight->id)
                        ->orderBy('id', 'desc')
                        ->paginate(50);
                @endphp
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="mb-0">Approvals</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">Received</th>
                                    <th scope="col" class="border-0">Message</th>
                                    <th scope="col" class="border-0">by</th>
                                    <th scope="col" class="border-0">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_pieces = 0; @endphp
                                @foreach ($approvals as $apro)
                                    @php
                                        $photos[] = json_decode($apro->photos);
                                        $total_pieces += $apro->pieces;
                                    @endphp
                                    <tr>
                                        <td>{{ $apro->pieces }}</td>
                                        <td>{{ $apro->message }}</td>
                                        <td>{{ ucwords($apro->user->name) }}</td>
                                        <td>{{ date('j, D M y H:i a', strtotime($apro->created_at)) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th> {{ $total_pieces }} </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        {{ $approvals->links('pagination::bootstrap-4') }}
                    </div>
                </div>


                @if( $photos != '')
                    <div class="card mt-2">
                        <div class="card-body row">
                            @foreach ($photos as $photos)
                                @if ($photos)
                                    @foreach ($photos as $photo)
                                        <div class="col-xl-3 col-md-4 col-6 mb-2">
                                            <img class="f-img f-cover img-fluid" src="{{ asset('assets/img/freight/' . $photo) }}"
                                                alt="">
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>



        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editFreight" tabindex="-1" role="dialog" aria-labelledby="editFreight"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Freight Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control.eidtFreight') }}" class="row">@csrf
                        <x-jet-validation-errors />
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Bill Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bill_number"
                                value="{{ $freight->bill_number }}" placeholder="Bill Number" required>
                            <input type="hidden" name="freight_id" value="{{ $freight->id }}">
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">Consignee <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="consignee" value="{{ $freight->consignee }}"
                                placeholder="Consignee" required>
                        </div>


                        <div class="mb-2 col-4">
                            <label class="form-label">Consignee Email</label>
                            <input type="text" name="consignee_email" class="form-control"
                                value="{{ $freight->consignee_email }}" placeholder="Consignee Email" required>
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Consignee Phone </label>
                            <input type="text" name="consignee_phone" class="form-control"
                                value="{{ $freight->consignee_phone }}" placeholder="Consignee Phone">
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Consignee Address</label>
                            <input type="text" name="consignee_address" class="form-control"
                                placeholder="Consignee Address" value="{{ $freight->consignee_address }}" required>
                        </div>




                        <div class="mb-2 col-md-6">
                            <label class="form-label">Shipper <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="shipper" value="{{ $freight->shipper }}"
                                placeholder="Shipper" required>
                        </div>


                        <div class="mb-2 col-md-6">
                            <label class="form-label">Destination <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="destination"
                                value="{{ $freight->destination }}" placeholder="Destination" required>
                        </div>

                        <div class="col-4">
                            <label class="form-label">No of Pieces <span class="text-danger">*</span> </label>
                            <input type="number" name="pieces" min="1" class="form-control"
                                value="{{ $freight->pieces }}" placeholder="Pieces" required>
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Weight(LBS) <span class="text-danger">*</span></label>
                            <input type="text" name="weight" class="form-control" value="{{ $freight->weight }}"
                                placeholder="Weight" required>
                        </div>


                        <div class="mb-2 col-4">
                            <label class="form-label">BYD Split <span class="text-danger">*</span></label>
                            <input type="text" name="byd_split" class="form-control" value="{{ $freight->byd_split }}"
                                placeholder="BYD Split" required>
                        </div>

                        <div class="mb-2 col-4">
                            <label class="form-label">Protect Service </label>
                            <input type="text" name="protective_service" class="form-control"
                                value="{{ $freight->protective_service }}" placeholder="Protective Service">
                        </div>

                        <div class="mb-2 col-4">
                            <label class="form-label">PU Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" value="{{ $freight->plac }}" required>
                        </div>

                        <div class="mb-2 col-4">
                            <label class="form-label">Due Date <span class="text-danger">*</span></label>
                            <input type="date" name="due_date" class="form-control" value="{{ $freight->due_date }}"
                                required>
                        </div>


                        <div class="mb-1 d-flex justify-content-end col-12">
                            <input type="checkbox" id="need_appointment"
                                {{ $freight->need_appoiment == 1 ? 'checked' : '' }} name="need_appointment" value="1"
                                class="form-check">

                            <label for="need_appointment" class="form-label ms-2"> Check If Appointment is Needed</label>

                        </div>




                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Freight</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="assignFreight" tabindex="-1" role="dialog" aria-labelledby="assignFreight"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Freight to Driver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @if($freight->status > 2)
                        <em>Freight has been assigned to {{ucwords($freight->driver->name)}}</em>
                    @endif
                    <form method="POST" action="{{ route('control.assignFreightToDriver') }}" class="row">
                        @csrf
                        <x-jet-validation-errors />

                        <div class="mb-2 col-12">

                            <label class="form-label">Driver<span class="text-danger">*</span></label>
                            <select name="driver_id" class="form-select" {{ $disabled }}>
                                <option selected disabled>...Select Driver...</option>
                                @foreach (\App\Models\User::where(['role' => 1, 'status' => 1])->orderby('name', 'ASC')->get() as $driver)
                                    <option
                                        @if($freight->status > 2) @php
                                            if($freight->assigned_to == $driver->id){ echo 'selected'; }
                                        @endphp @endif
                                         value="{{ $driver->id }}">{{ ucwords($driver->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="freight_id" value="{{ $freight->id }}">
                        </div>
                        <div class="mb-2 col-12">
                            <label class="form-label">Pieces to Deliver<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" disabled value="{{ $stock }}" >
                            <input type="hidden" name="pieces" value="{{ $stock }}" >
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            {{-- {{($assigned ==$freight->pieces) ? 'disabled' : '' ; }} --}}
                            <button type="submit" {{ $disabled }} class="btn btn-sm btn-primary">Assign</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>






    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/littleAlert.js') }}"></script>
@endsection
