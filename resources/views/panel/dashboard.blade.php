@extends('layouts.panel')

@section('title', 'Dashboard')

@section('content')

    <x-panel.breadcrumb title="Dashboard" page="Dashboard" />


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-4 g-3">
        <div class="col">
            <div class="card radius-10 shadow-none bg-light-success mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="fs-2 text-success"><ion-icon name="card-sharp"></ion-icon></div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="">
                            <p class="mb-1 text-success">Total Income</p>
                            <h4 class="mb-0 text-success">$0</h4>
                        </div>
                        <div class="ms-auto">
                            <p class="mb-0 text-success">0
                                {{-- <ion-icon name="arrow-up-sharp"></ion-icon> --}}
                                <ion-icon name="remove-outline"></ion-icon>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 shadow-none bg-light-primary mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="fs-2 text-primary"><ion-icon name="bag-check-sharp"></ion-icon></div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="">
                            <p class="mb-1 text-primary">Total Orders</p>
                            <h4 class="mb-0 text-primary">0</h4>
                        </div>
                        <div class="ms-auto">
                            <p class="mb-0 text-primary">0
                                {{-- <ion-icon name="arrow-up-sharp"></ion-icon> --}}
                                <ion-icon name="remove-outline"></ion-icon>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 shadow-none bg-light-danger mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="fs-2 text-danger"><ion-icon name="time-outline"></ion-icon></div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="">
                            <p class="mb-1 text-danger">Pending Orders</p>
                            <h4 class="mb-0 text-danger">0</h4>
                        </div>
                        <div class="ms-auto">
                            <p class="mb-0 text-danger">0
                                {{-- <ion-icon name="arrow-up-sharp"></ion-icon> --}}
                                <ion-icon name="remove-outline"></ion-icon>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 shadow-none bg-light-success mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="fs-2 text-success"><ion-icon name="checkmark-done-circle-outline"></ion-icon></div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="">
                            <p class="mb-1 text-success">Fullfilled Orders</p>
                            <h4 class="mb-0 text-success">0</h4>
                        </div>
                        <div class="ms-auto">
                            <p class="mb-0 text-success">0
                                {{-- <ion-icon name="arrow-up-sharp"></ion-icon> --}}
                                <ion-icon name="remove-outline"></ion-icon>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-4 mt-4">

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Pending Packages</p>
                            <h4 class="mb-0 text-primary">0</h4>
                        </div>
                        <div class="ms-auto text-primary fs-2">
                            <ion-icon name="cube-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Pending Shipments</p>
                            <h4 class="mb-0 text-primary">0</h4>
                        </div>
                        <div class="ms-auto text-primary fs-2">
                            <ion-icon name="bicycle-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Returned Packages</p>
                            <h4 class="mb-0 text-primary">0</h4>
                        </div>
                        <div class="ms-auto text-primary fs-2">
                            <ion-icon name="return-up-back-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Cancelled Orders</p>
                            <h4 class="mb-0 text-primary">0</h4>
                        </div>
                        <div class="ms-auto text-primary fs-2">
                            <ion-icon name="close-circle-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card radius-10 bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-white">Members</p>
                            {{-- <h4 class="mb-0 text-white">{{ $members }}</h4> --}}
                        </div>
                        <div class="ms-auto text-white fs-2">
                            <ion-icon name="accessibility-sharp"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-white">Customers</p>
                            <h4 class="mb-0 text-white">0</h4>
                        </div>
                        <div class="ms-auto text-white fs-2">
                            <ion-icon name="walk-sharp"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-white">Active Products</p>
                            {{-- <h4 class="mb-0 text-white">{{ $activeProducts }}</h4> --}}
                        </div>
                        <div class="ms-auto text-white fs-2">
                            <ion-icon name="ice-cream-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-white">Draft Products</p>
                            {{-- <h4 class="mb-0 text-white">{{ $draftProducts }}</h4> --}}
                        </div>
                        <div class="ms-auto text-white fs-2">
                            <ion-icon name="pizza-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->


@stop


@section('scripts')

    {{--    <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script> --}}
    {{--    <script src="{{ asset('assets/plugins/easyPieChart/jquery.easypiechart.js') }}"></script> --}}
    {{--    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script> --}}
    {{--    <script src="{{ asset('assets/js/index.js') }}"></script> --}}
    {{--    <!--plugins--> --}}
    {{--    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script> --}}

@stop
