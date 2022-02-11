@extends('layouts/app')
@section('title')
    Delivery History
@endsection
@section('pagecontent')

    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">



    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Delivery History
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">
                                    Delivery History
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @php
            $freights = \App\Models\Freight::where(['driver_id' => auth()->user()->id])->orderBy('id', 'desc')->paginate(100);
        @endphp



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="dataTableBasic2" class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
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
                                @php
                                    $t_pal = 0;
                                    $t_spil = 0;
                                    $t_wgt = 0;
                                @endphp
                                @foreach ($freights as $fre)
                                @php
                                    $t_pal += $fre->pallet;
                                    $t_spil += $fre->byd_split;
                                    $t_wgt += $fre->weight;
                                @endphp
                                    <tr class="single">
                                        <td>
                                            <input type="checkbox" data-id="{{$fre->id}}inp" class="ooooo" value="{{$fre->id}}">
                                            <input type="hidden" id="{{$fre->id}}inp" value=0>
                                            {{$loop->iteration}}
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

                                <tr>
                                    <th colspan="5"></th>
                                    <th >{{number_format($t_pal)}} | {{number_format($t_wgt)}} LBS</th>
                                    <th>{{number_format($t_spil)}}</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>With Selected:</b></td>
                                    <td colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-sm btn-info float-right update">Update Status</button>
                                        </div>
                                    </td>
                                    <td colspan="3"></td>
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


    @include('driver.modal')



    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/delivery.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>




@endsection
