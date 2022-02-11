@extends('layouts/app')
@section('title')
    Refused Delivery
@endsection
@section('pagecontent')

    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">



    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Refused Delivery
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">
                                    Refused Delivery
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @php
            $orders = \App\Models\Delivery::where(['driver_id' => auth()->user()->id, 'status' => 3 ])->orderBy('id', 'desc')->paginate(100);
        @endphp



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="dataTableBasic2" class="table table-sm mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">Pieces</th>
                                    <th scope="col" class="border-0">CONSIGNEE</th>
                                    <th scope="col" class="border-0">DESTINATION</th>
                                    <th scope="col" class="border-0">Message</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $ord)
                                    <tr>
                                        <td class="align-middle">{{ $ord->pieces }} </td>
                                        <td class="align-middle">{{ $ord->freight->consignee }} <br> {{ $ord->freight->consignee_phone }} {{ $ord->freight->consignee_email }}  </td>
                                        <td class="align-middle">{{ $ord->freight->destination }} ({{ $ord->freight->due_date }}) </td>
                                        <td class="align-middle"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        {{ $orders->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <script>
        $('#dataTableBasic2').DataTable( {
            paging: false,
        } );
    </script>


@endsection
