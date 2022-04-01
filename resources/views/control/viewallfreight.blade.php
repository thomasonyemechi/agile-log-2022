@extends('layouts/app')
@section('title')
Manage Freight
@endsection
@section('pagecontent')

    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">



    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">




                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Manage Freights
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">
                                    Manage Freights
                                </li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>





        <div class="row">
            <div class="col-12">

                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="mb-0">Add Freight </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('control.createFreight') }}" class="row">@csrf
                            <div class="mb-2 col-md-6">
                                <label class="form-label">Company <span class="text-danger">*</span></label>
                                <select name="org_id" class="form-control">
                                    <option selected disabled>...Select Option...</option>
                                    @foreach (\App\Models\Organization::get(['id', 'name', 'email', 'address']) as $org)
                                        <option @if ($org->id == session()->get('org_id')) selected @endif value="{{$org->id}}">{{$org->name}} | {{$org->email}} | {{$org->address}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-2 col-md-6">
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
                                <label class="form-label">Split <span class="text-danger">*</span></label>
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
                                <button type="submit" class="btn btn-primary">Add Freight</button>
                            </div>
                        </form>
                    </div>
                </div>



                @php
                    $freights = \App\Models\Freight::with(['driver:id,name,email,phone', 'org:id,name,email,phone'])->orderBy('id', 'desc')->paginate(100);
                @endphp

                <div class="card">
                    <div class="table-responsive">
                        <table id="dtt" class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Org</th>
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
                                        $req_data = ['id' => $fre->id, 'pro' => $fre->pro, 'company' => $fre->org->name];
                                    @endphp
                                    <tr class="single {{($fre->approved == 0) ? 'text-danger' : ''}}"  style="border-color:{{($fre->approved == 0) ? 'brown' : ''}}; " >
                                        <td>
                                            <input type="checkbox" data-id="{{$fre->id}}inp" class="ooooo" value="{{$fre->id}}" daat='{{json_encode($req_data)}}' >
                                            <input type="hidden" id="{{$fre->id}}inp" value=0>
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="align-middle" style="font-weight: bolder">
                                             {!!'<a class="text-bold" href="/control/o/freight/'.$fre->org->id.'/'.date('Y-m-j').' ">'.$fre->org->name.' </a>' !!}  </td>
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


    <div class="modal fade" id="assignFreight" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Freight To Driver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control.assign.freight') }}" class="row">@csrf
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Loader <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="loader"
                                placeholder="Loader name" required>
                                <input type="hidden" name="data">
                        </div>
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Driver <span class="text-danger">*</span></label>
                            <select name="driver_id" class="form-control" id="">
                                <option selected disabled>... Select Driver</option>
                                @foreach (\App\Models\User::where('role', 1)->get(['id', 'name']) as $use)
                                    <option value="{{$use->id}}">{{$use->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2 col-md-12">
                            <i class="text-danger"><b>Note:</b> Freight that has already been processed/assigned to other drivers will be skipped!</i>
                        </div>


                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary ">Assign</button>
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



    <div class="modal fade" id="approve_freight" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered moda" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approved Selected Freight</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/control/approve_freight" enctype="multipart/form-data">
                        @csrf
                        <div class="approve_body">

                        </div>

                        <button class="btn btn-primary float-right submit_approval">Approve Freights</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="freight_details" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Freight Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">


                </div>

            </div>
        </div>
    </div>


    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>

    <script>
        $(function() {
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


            function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];


    return `${day} ${monthNames[month - 1]}, ${year}`;
}


            $('.approve_freight').on('click', function () {
                trs = $('.single'); data = []; i = 0;
                trs.map(tr => {
                    check = trs[tr].children[0].children[1].value;
                    if(check == 1) {
                        f_id = trs[tr].children[0].children[0].value;
                        info = JSON.parse(trs[tr].children[0].children[0].getAttribute('daat'))
                        data.push(info)
                        i++;
                    }
                });
                // if(i == 0) { alert('Pls select freight to Approve'); return; }
                console.log(data);

                modal = $('#approve_freight');
                modal.modal('show');
                body = $('.approve_body')
                body.html(''); i = 0
                data.map((fr, index) => {
                    console.log(fr);
                    i++;
                    body.append(`
                        <div class="approve_single">
                            <b>${fr.pro} (${fr.company})</b>
                            <input type="file" name="file_${index}" accept="image/jpeg"  class="form-control approve_files">
                            <input type="hidden" name="id_${index}" class="approve_id" value="${fr.id}">
                            <textarea name="message_${index}" class="form-control mt-2 approve_message"  placeholder="Enter Freight Message"></textarea>
                        </div>
                        <hr>
                    `)
                })

                body.append(`<input type="hidden" name="total" value="${i}">`)
            })


            // $('.submit_approval').on('click', function(e) {
            //     e.preventDefault();
            //     data = [];
            //     freights = $('.approve_single')
            //     freights.map(freight => {
            //         freight = freights[freight]
            //         files = freight.children[1].value
            //         id = freight.children[2].value
            //         message = freight.children[3].value
            //         info = { id: id, message:message, file: files  }
            //         data.push(info)
            //     });

            //     $.ajax({
            //         method: 'post',
            //         url: '/control/approve_freight',
            //         headers: {
            //             "X-CSRF-TOKEN": `{{csrf_token()}}`
            //         },
            //         data: data,
            //         processData: false,
            //         contentType: false,
            //     }).done(function(res){
            //         console.log(res);
            //     }).fail(function(res) {
            //         console.log(res);
            //     })


            // })

            $('body').on('click', '.view_more', function() {
                data = $(this).data('data');
                console.log(data);
                modal = $('#freight_details');
                modal.modal('show');

                body = modal.find('.modal-body');
                body.html(``);

                modal.find('.modal-title').html(`Freight Details (${data.pro})`);

                a = data.approved;
                a_info = JSON.parse(data.approved_info);
                console.log(a_info);

                a_body = (a == 1) ? `
                    <div class="d-flex justify-content-between">
                        <span>Approved_By: <b>User</b></span>|
                        <span>Date: <b>${formatDate(a_info.time)}</b></span>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between">
                        <span>Message: <b>${a_info.message}</b></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <img src="{{ asset('assets/img/freight/${a_info.image}') }}" class="image-fluid" style="width: 100%" alt="">
                    </div>
                ` : `<div class="alert alert-danger">Freight Has not been approved</div>`;


                driver_body = (data.driver_id > 0) ? `
                     <div class="d-flex justify-content-between">
                        <span>Name: <b>${data.driver.name}</b></span>|
                        <span>Email: <b>${data.driver.email}</b></span>|
                        <span>Phone: <b>${data.driver.phone}</b></span>
                    </div>
                `: `<div class="alert alert-danger">Freight has not been assigned to a driver </div>`
                body.append(`
                    <div class="card mb-2 ">
                        <div class="card-header p-1 bg-primary">
                            <h5 class="card-title mb-0 text-white">Freight Info</h5>
                        </div>
                        <div class="card-body p-1">
                            <div class="d-flex justify-content-between">
                                <span>Pro: <b>${data.pro}</b></span>|
                                <span>Pallet: <b>${data.pallet}</b></span>|
                                <span>Weight: <b>${data.weight} LBS</b></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Split: <b>$ ${data.byd_split}</b></span>|
                                <span>Spec INS: <b>${data.spec_ins}</b></span>|
                                <span>Weight: <b>${data.weight} LBS</b></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Cosignee: <b>${data.consignee}</b></span>|
                                <span>Destination: <b>${data.destination}</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header p-1 bg-info">
                            <h5 class="card-title mb-0">Driver Info</h5>
                        </div>
                        <div class="card-body p-1">
                            ${driver_body}
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header p-1 bg-info">
                            <h5 class="card-title mb-0">Company Info</h5>
                        </div>
                        <div class="card-body p-1">
                            <div class="d-flex justify-content-between">
                                <span>Name: <b>${data.org.name}</b></span>|
                                <span>Phone: <b>${data.org.phone}</b></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Email: <b>${data.org.email}</b></span>|
                                <span>Address: <b>${data.org.email}</b></span>
                            </div>

                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header p-1">
                            <h5 class="card-title mb-0">Company Info</h5>
                        </div>
                        <div class="card-body p-1">
                            <div class="d-flex justify-content-between">
                                <span>Name: <b>Road Runner</b></span>|
                                <span>Phone: <b>+1 (192) 733 3237 323</b></span>
                            </div>
                            <hr>

                            <div class="d-flex justify-content-between">
                                <span>Email: <b>email@company.com</b></span>|
                                <span>Address: <b>456 MERRICK RD CORP SPEC LYNBROOK NY 11563</b></span>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-2">
                        <div class="card-header p-1 bg-success">
                            <h5 class="card-title mb-0">Approval Info</h5>
                        </div>
                        <div class="card-body p-1">
                            ${a_body}
                        </div>
                    </div>
                `)
            })

        })
    </script>


@endsection
