@extends('layouts/app')
@section('title')
    Organization | {{ ucwords($org->name) }}
@endsection
@section('pagecontent')

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
                    $freights = \App\Models\Freight::where('org_id', $org->id)->orderby('id', 'desc')->paginate(100);
                @endphp

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="mb-0">All Freights Record</h4>
                        <button data-bs-toggle="modal" data-bs-target="#addFreight" class="btn btn-primary btn-xs"> Add Freight</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">OFD Date</th>
                                    <th scope="col" class="border-0">Driver</th>
                                    <th scope="col" class="border-0">Pro/status</th>
                                    <th scope="col" class="border-0">Consignee</th>
                                    <th scope="col" class="border-0">Destination</th>
                                    <th scope="col" class="border-0">Spec Ins</th>
                                    <th scope="col" class="border-0">Pallet</th>
                                    <th scope="col" class="border-0">Split</th>
                                    <th scope="col" class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($freights as $fre)
                                    <tr class="single">
                                        <td>
                                            <input type="checkbox" data-id="{{$fre->id}}inp" class="ooooo" value="{{$fre->id}}">
                                            <input type="hidden" id="{{$fre->id}}inp" value=0>
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="align-middle">{{ ($fre->ofd_time > 0) ? date('j M, Y', $fre->ofd_time): '' }} </td>
                                        <td class="align-middle">{{ $fre->driver->name ?? 'No Driver assigned' }} </td>

                                        <td class="align-middle">
                                            <a href="#" class="freightInfo align-middle" style="font-weight: bolder"
                                            title="click for more">{{$fre->pro }} {!! deliveryProStatus($fre->status) !!} </a>
                                        </td>
                                        <td class="align-middle"> {{$fre->consignee}} </td>
                                        <td class="align-middle">{{ $fre->destination }}</td>
                                        <td class="align-middle">{{ $fre->spec_ins }}</td>
                                        <td class="align-middle">{{ $fre->pallet }} | {{ $fre->weight }} LBS</td>
                                        <td class="align-middle">{{ $fre->byd_split }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="2"><b>With Selected:</b></td>
                                    <td colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-sm btn-info float-right assign">Assign To Driver</button>
                                            <button class="btn ms-2 btn-sm btn-primary float-right update">Update Status</button>
                                        </div>
                                    </td>
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
                        <div class="mb-2 col-md-12">
                            <label class="form-label">Driver <span class="text-danger">*</span></label>
                            <select name="driver_id" class="form-control">
                                <option selected disabled>...Select Driver...</option>
                                @foreach (\App\Models\User::where(['role' => 1])->get(['id',  'name']) as $dri)
                                    <option value="{{$dri->id}}">{{$dri->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <label class="form-label">PRO <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="pro" value="{{ old('pro') }}"
                                placeholder="Bill Number" required>
                                <input type="hidden" name="org_id" value="{{ $org->id }}">
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

                        <div class="mb-2 col-2">
                            <label class="form-label">Weight(LBS) <span class="text-danger">*</span></label>
                            <input type="number" name="weight" class="form-control" value="{{ old('weight') }}"
                                placeholder="Weight" required>
                        </div>
                        <div class="mb-2 col-2">
                            <label class="form-label">BYD Split <span class="text-danger">*</span></label>
                            <input type="number" name="byd_split" class="form-control" value="{{ old('byd_split') }}"
                                placeholder="BYD Split" required>
                        </div>

                        <div class="mb-2 col-2">
                            <label class="form-label">PALLET <span class="text-danger">*</span></label>
                            <input type="number" name="pallet" class="form-control" value="{{ old('pallet') }}"
                                placeholder="Pallet" required>
                        </div>

                        <div class="mb-2 col-6">
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



    <div class="modal fade" id="editFreight" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
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
                        <div class="mb-2 col-md-3">
                            <label class="form-label">PRO <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="pro"
                                placeholder="Bill Number" required>
                                <input type="hidden" name="freight_id">
                        </div>
                        <div class="mb-2 col-md-4">
                            <label class="form-label">Consignee <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="consignee"
                                placeholder="Consignee" required>
                        </div>

                        <div class="mb-2 col-md-5">
                            <label class="form-label">Destination <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="destination" placeholder="Destination" required>
                        </div>

                        <div class="mb-2 col-2">
                            <label class="form-label">Weight(LBS) <span class="text-danger">*</span></label>
                            <input type="number" name="weight" class="form-control"
                                placeholder="Weight" required>
                        </div>
                        <div class="mb-2 col-2">
                            <label class="form-label">BYD Split <span class="text-danger">*</span></label>
                            <input type="number" name="byd_split" class="form-control"
                                placeholder="BYD Split" required>
                        </div>

                        <div class="mb-2 col-2">
                            <label class="form-label">PALLET <span class="text-danger">*</span></label>
                            <input type="number" name="pallet" class="form-control"
                                placeholder="Pallet" required>
                        </div>

                        <div class="mb-2 col-6">
                            <label class="form-label">Spec Instruction <span class="text-danger">*</span></label>
                            <input type="text" name="spec_ins" class="form-control"
                                placeholder="Spec Instruction" required>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary ">Update Freight</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="updateFreight" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Freight</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control.assign.freight.update') }}" class="row">@csrf
                        <div class="mb-2 col-12">
                            <label>Select Action</label>
                            <select name="action" class="form-control">
                                <option selected disabled>...Select option...</option>
                                <option value="4">Off for delivery</option>
                                <option value="5">Sucessfully delivered</option>
                                <option value="6">Refused/Flagged item</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-12">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="3" placeholder="Enter a message"></textarea>
                                <input type="hidden" name="data">
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    @include('control.assign_modal')



    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script>
        $(function() {
            $('body').on('click', '.updateFreight', function(e) {
                e.preventDefault(); data = $(this).data('data');
                console.log(data);
                modal = $('#editFreight');
                modal.modal('show')
                $(modal).find('input[name="freight_id"]').val(data.id);
                $(modal).find('input[name="pro"]').val(data.pro);
                $(modal).find('input[name="consignee"]').val(data.consignee);
                $(modal).find('input[name="destination"]').val(data.destination);
                $(modal).find('input[name="weight"]').val(data.weight);
                $(modal).find('input[name="byd_split"]').val(data.byd_split);
                $(modal).find('input[name="spec_ins"]').val(data.spec_ins);
                $(modal).find('input[name="pallet"]').val(data.pallet);
                $(modal).find('.modal-title').html(`Edit Freight Info (${data.pro})`);
            })


            $('body').on('click', '.ooooo', function() {
                val = $(this).data('id');
                inp = $(`#${val}`)
                new_val = (inp.val() == 0 ) ? 1 : 0;
                inp.val(new_val);

            })


            $('body').on('click', '.assign', function() {
                trs = $('.single'); data = []; i = 0;
                trs.map(tr => {
                    check = trs[tr].children[0].children[1].value;
                    if(check == 1) {
                        f_id = trs[tr].children[0].children[0].value;
                        data.push(parseInt(f_id))
                        i++;
                    }
                });
                if(i == 0) { alert('Pls select freight to assign'); return; }
                modal = $('#assignFreight');
                modal.modal('show');

                $(modal).find('.modal-title').html(`Assign ${i} Freight To Driver`);
                $(modal).find('input[name="data"]').val(`${JSON.stringify(data)}`);
            })


            $('body').on('click', '.update', function() {
                trs = $('.single'); data = []; i = 0;
                trs.map(tr => {
                    check = trs[tr].children[0].children[1].value;
                    if(check == 1) {
                        f_id = trs[tr].children[0].children[0].value;
                        data.push(parseInt(f_id))
                        i++;
                    }
                });
                if(i == 0) { alert('Pls select freight to update'); return; }
                modal = $('#updateFreight');
                modal.modal('show');

                $(modal).find('.modal-title').html(`Update ${i} Freight Status`);
                $(modal).find('input[name="data"]').val(`${JSON.stringify(data)}`);
                console.log(data);
            })


        })
    </script>





@endsection
