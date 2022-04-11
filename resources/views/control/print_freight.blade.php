
@extends('layouts/app')
@section('title')
    Print Freight
@endsection
@section('pagecontent')



@php
$start = strtotime($date);

$freights = \App\Models\Freight::where(['driver_id' => $driver->id,])->whereBetween('ofd_time', [$start, $start+(86400-1)])->orderBy('id', 'desc')->paginate(100);
@endphp




    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                             {{$driver->name}} ({{date('j M, Y', $start)}})
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">
                                    Printer
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-">
                        <table id="dtt" class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Manifest</th>
                                    <th scope="col" class="border-0">Pro</th>
                                    <th scope="col" class="border-0">Consignee</th>
                                    <th scope="col" class="border-0">Destination</th>
                                    <th scope="col" class="border-0">Spec Ins</th>
                                    <th scope="col" class="border-0">Pallet</th>
                                    <th scope="col" class="border-0">Wgt</th>
                                    <th scope="col" class="border-0">Split</th>
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
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="align-middle">
                                            {{$fre->manifest_number}}
                                        </td>
                                        <td class="align-middle">
                                            <a href="#" class="freightInfo align-middle" style="font-weight: bolder"
                                            title="click for more">{{$fre->pro }} {!! deliveryProStatus($fre->status) !!} </a>
                                        </td>
                                        <td class="align-middle"> {{$fre->consignee}} </td>
                                        <td class="align-middle">{{ $fre->destination }}</td>
                                        <td class="align-middle">{{ $fre->spec_ins }}</td>
                                        <td class="align-middle">{{ $fre->pallet }}</td>
                                        <td class="align-middle">{{ $fre->weight }}</td>
                                        <td class="align-middle">{{ $fre->byd_split }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <td>{{number_format($t_pal)}} </td>
                                    <th >{{number_format($t_wgt)}}</th>
                                    <th>{{number_format($t_spil)}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>





@endsection

