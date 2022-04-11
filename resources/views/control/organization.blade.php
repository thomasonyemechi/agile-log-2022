@extends('layouts/app')
@section('title')
    Organization | {{ ucwords($org->name) }}
@endsection
@section('pagecontent')


    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>

    <script>
        const showUpdateFileSection = () => {
            action = $('#update_freight_status').val();
            if(action == 5) { $('.update_freight_file').show(); }else {
                $('.update_freight_file').hide();
            }
        }
    </script>



    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            {{ ucwords($org->name) }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="admin-dashboard.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ ucwords($org->name) }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <button type="button" class="btn  btn-outline-white active" data-bs-toggle="modal"
                            data-bs-target="#editOrganization">
                            <span class="fe fe-edit"></span> Edit Company Info
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">

                @php
                $freights = \App\Models\Freight::with(['driver:id,name,email,phone', 'org:id,name,email,phone,address'])->where('org_id', $org->id)->orderBy('id', 'desc')->paginate(100);
                @endphp

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="mb-0">All Freights Record</h4>
                        <button data-bs-toggle="modal" data-bs-target="#addFreight" class="btn btn-primary btn-xs"> Add Freight</button>
                    </div>
                    <div class="table-responsive">
                        <table id="dtt" class="table table-sm table-hover table-striped mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Manifest</th>
                                    <th scope="col" class="border-0">OFD Date</th>
                                    <th scope="col" class="border-1">Driver</th>
                                    <th scope="col" class="border-0">Pro/status</th>
                                    <th scope="col" class="border-0">Consignee</th>
                                    <th scope="col" class="border-0">Destination</th>
                                    <th scope="col" class="border-0">Spec Ins</th>
                                    <th scope="col" class="border-0">Pallet</th>
                                    <th scope="col" class="border-0">Split</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($freights as $fre)
                                    @php
                                        $req_data = ['id' => $fre->id, 'pro' => $fre->pro, 'company' => $fre->org->name, 'pallet' => $fre->pallet];

                                        // print_r($req_data);
                                    @endphp
                                    <tr class="single {{($fre->approved == 0) ? 'text-danger' : ''}}"  style="border-color:{{($fre->approved == 0) ? 'brown' : ''}}; " >
                                        <td>
                                            <input type="checkbox" data-id="{{$fre->id}}inp" class="ooooo" value="{{$fre->id}}" daat='{{json_encode($req_data)}}' >
                                            <input type="hidden" id="{{$fre->id}}inp" value=0>
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="align-middle">
                                            {{$fre->manifest_number}}
                                        </td>
                                        <td class="align-middle">{{ ($fre->ofd_time > 0) ? date('j M, Y', $fre->ofd_time): '' }} </td>
                                        <td class="align-middle" style="font-weight: bolder">
                                            {!! ($fre->driver) ? '<a class="text-bold" href="/control/d/freight/'.$fre->driver->id.'/'.date('Y-m-j').' ">'.$fre->driver->name.' </a>' : 'No Driver assigned' !!}
                                        </td>
                                        <td class="align-middle">
                                            <a href="#" class="freightInfo align-middle"
                                            title="click for more">{{$fre->pro }} {!! deliveryProStatus($fre->status) !!} </a>
                                        </td>
                                        <td class="align-middle"> {{$fre->consignee}} </td>
                                        <td class="align-middle">{{ $fre->destination }}</td>
                                        <td class="align-middle">{{ $fre->spec_ins }}</td>
                                        <td class="align-middle">{{ $fre->pallet }} | {{ $fre->weight }} LBS</td>
                                        <td class="align-middle">{{ $fre->byd_split }}</td>
                                        <td class="align-middle"><button class="btn btn-sm btn-info view_more" data-data='{{json_encode($fre)}}'>More</button></td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>With Selected:</b></td>
                                    <td></td>

                                    <td><button class="btn btn-sm btn-info float-right approve_freight">Approve</button></td>
                                    <td>
                                        <button class="btn btn-sm btn-info float-right assign">Assign</button>
                                    </td>
                                    <td><button class="btn ms-2 btn-sm btn-primary float-right update">Update</button></td>


                                    <td></td>

                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>


                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        {{ $freights->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>





    <div class="modal fade" id="editOrganization" tabindex="-1" role="dialog" aria-labelledby="editOrganization"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrganization">Edit Organization Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('control.editOrganizationInfo') }}" method="POST"
                        enctype="multipart/form-data" class="row">@csrf

                        <div class="mb-2 col-6">
                            <div class="mb-2">
                                <label class="form-label">Organization Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ $org->name }}"
                                    placeholder="Organization name" required>
                                <input type="hidden" name="org_id" value="{{ $org->id }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label"> Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $org->email }}"
                                    placeholder="Email Address">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" value="{{ $org->phone }}"
                                    placeholder="Enter phone" required>
                            </div>


                            <div class="mb-2">
                                <label class="form-label">Address </label>
                                <textarea name="address" class="form-control" rows="2"
                                    placeholder="Address"> {{ $org->address }}</textarea>
                            </div>


                        </div>

                        <div class="mb-2 col-6">
                            <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                                <label class="form-label">Organization Logo
                                    <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                        title="Clear Image"></a></label>
                                <label class="custom-file-container__custom-file">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                        accept="image/*" name="logo" />
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
        </div>
    </div>



    <div class="modal fade" id="addFreight" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFreight">Add Freight</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control.createFreight') }}" class="row">@csrf
                        <div class="mb-2 col-md-4">
                            <label class="form-label">Driver <span class="text-danger">*</span></label>
                            <select name="driver_id" class="form-control">
                                <option selected disabled>...Select Driver...</option>
                                @foreach (\App\Models\User::where(['role' => 1])->get(['id',  'name']) as $dri)
                                    <option value="{{$dri->id}}">{{$dri->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="org_id" value="{{ $org->id }}">
                        </div>
                        <div class="mb-2 col-md-4">
                            <label class="form-label">Manifest Number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="manifest_number" value="{{ old('manifest_number') }}"
                                placeholder="Manifest Number" required>
                        </div>

                        <div class="mb-2 col-md-4">
                            <label class="form-label">PRO <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="pro" value="{{ old('pro') }}"
                                placeholder="Bill Number" required>
                        </div>



                        <div class="mb-2 col-md-6">
                            <label class="form-label">City </label>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}"
                                placeholder="City" required>
                        </div>


                        <div class="mb-2 col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" value="{{ old('location') }}"
                                placeholder="Location" required>
                        </div>



                        <div class="mb-2 col-md-4">
                            <label class="form-label">Consignee <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="consignee" value="{{ old('consignee') }}"
                                placeholder="Consignee" required>
                        </div>

                        <div class="mb-2 col-md-5">
                            <label class="form-label">Destination <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="destination" value="{{ old('destination') }}" placeholder="Destination" required>
                        </div>

                        <div class="mb-2 col-3">
                            <label class="form-label">Weight(LBS) <span class="text-danger">*</span></label>
                            <input type="number" name="weight" class="form-control" value="{{ old('weight') }}"
                                placeholder="Weight" required>
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Split <span class="text-danger">*</span></label>
                            <input type="number" name="byd_split" class="form-control" value="{{ old('byd_split') }}"
                                placeholder="BYD Split" required>
                        </div>

                        <div class="mb-2 col-4">
                            <label class="form-label">PALLET <span class="text-danger">*</span></label>
                            <input type="number" name="pallet" class="form-control" value="{{ old('pallet') }}"
                                placeholder="Pallet" required>
                        </div>

                        <div class="mb-2 col-4">
                            <label class="form-label">Spec Instruction <span class="text-danger">*</span></label>
                            <input type="text" name="spec_ins" class="form-control" value="{{ old('spec_ins') }}"
                                placeholder="Spec Instruction" required>
                        </div>

                        <div class="mb-1 d-flex justify-content-end col-12">
                            <input type="checkbox" id="apt" name="apt" value="1"
                                class="form-check">
                            <label for="apt" class="form-label ms-2"> Check If Appointment is Needed</label>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Freight</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @include('control.modal_scripts')



@endsection
