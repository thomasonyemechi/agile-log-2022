@extends('layouts/app')
@section('title')
    Search result
@endsection
@section('pagecontent')

@include('control.assign_modal')


    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Search result for '{{$q}}'
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">
                                    Search result
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @php
            $freights = \App\Models\Freight::
            orWhere('pro', 'like', "%$q%")
            ->orWhere('consignee', 'like', "%$q%")
            ->orWhere('destination', 'like', "%$q%")
            ->orWhere('weight', 'like', "%$q%")
            ->orWhere('byd_split', 'like', "%$q%")
            ->orWhere('spec_ins', 'like', "%$q%")
            ->orWhere('pallet', 'like', "%$q%")
            ->orWhere('manifest_number', 'like', "%$q%")
            ->paginate(200);
        @endphp




        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="mytb" class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Manifest</th>
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
                                        <td class="align-middle">
                                            {{$fre->manifest_number}}
                                        </td>
                                        <td class="align-middle">
                                            <a href="#" class="freightInfo align-middle" style="font-weight: bolder">{{$fre->pro }} {!! deliveryProStatus($fre->status) !!}</a>
                                        </td>
                                        <td class="align-middle"> {{$fre->consignee}} </td>
                                        <td class="align-middle">{{ $fre->destination }}</td>
                                        <td class="align-middle">{{ $fre->spec_ins }}</td>
                                        <td class="align-middle">{{ $fre->pallet }} | {{ $fre->weight }} LBS</td>
                                        <td class="align-middle">{{ $fre->byd_split }}</td>
                                    </tr>
                                @endforeach
                                {{-- <tr>
                                    <td colspan="2"><b>With Selected:</b></td>
                                    <td colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-sm btn-info float-right assign">Assign To Driver</button>
                                        </div>
                                    </td>
                                    <td colspan="3"></td>
                                </tr> --}}
                            </tbody>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        {{ $freights->links('pagination::bootstrap-4') }}
                    </div>
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
        })
    </script>



@endsection
