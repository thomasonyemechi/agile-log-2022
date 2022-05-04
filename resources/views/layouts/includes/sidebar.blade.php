@if (auth()->user()->role > 1)

    <nav class="navbar-vertical navbar">
        <div class="nav-scroller">
            <!-- Brand logo -->
            <a class="navbar-brand" href="/control/">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" />
            </a>
            <!-- Navbar nav -->
            <ul class="navbar-nav flex-column" id="sideNavbar">
                @if(auth()->user()->role == 5) {
                    <li class="nav-item">
                        <a class="nav-link" href="/control/">
                            <i class="nav-icon fe fe-home me-2"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#!" data-bs-toggle="collapse" data-bs-target="#orgNav"
                            aria-expanded="false" aria-controls="orgNav">
                            <i class="nav-icon fe fe-users me-2"></i> Companies
                        </a>
                        <div id="orgNav" class="collapse " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link " href="/control/organization/new">
                                        Add New Company
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="/control/organizations/all">View all Companies</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link" href="/control/addnewstaff">
                            <i class="nav-icon fe fe-user me-2"></i> All Staffs
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="/control/all/staff">
                            <i class="nav-icon fe fe-eye me-2"></i> View all Staffs
                        </a>
                    </li>

                @endif

                <li class="nav-item">
                    <a class="nav-link " href="/control/all/freight">
                        <i class=" nav-icon fe fe-database me-2"></i> Manage Freight
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link " href="/control/freight/ofd">
                        <i class=" nav-icon fe fe-database me-2"></i> Out For delivery Freight
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link " href="/control/freight/flagged">
                        <i class=" nav-icon fe fe-database me-2"></i> Refused/Flagged Freight
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="/control/freight/delivered">
                        <i class=" nav-icon fe fe-database me-2"></i> Delivered Freight
                    </a>
                </li>


                @if(auth()->user()->role == 5) {
                    <li class="nav-item">
                        <a class="nav-link" href="#!" data-bs-toggle="collapse" data-bs-target="#driverNav"
                            aria-expanded="false" aria-controls="driverNav">
                            <i class="nav-icon fe fe-user me-2"></i> Driver Management
                        </a>
                        <div id="driverNav" class="collapse " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link " href="/control/driver/add">
                                        Add Driver
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="/control/driver/all">All Drivers</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif


            </ul>

        </div>
    </nav>


@else



    <nav class="navbar-vertical navbar">
        <div class="nav-scroller">
            <a class="navbar-brand" href="/control/">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" />
            </a>
            <ul class="navbar-nav flex-column" id="sideNavbar">

                <li class="nav-item">
                    <a class="nav-link" href="/driver/new/delivery">
                        <i class="nav-icon fe fe-book me-2"></i> Pending Delivery
                        <span class="badge bg-warning ms-2">
                            {{\App\Models\Freight::where(['driver_id' => auth()->user()->id, 'status' => 3 ])->orderBy('id', 'desc')->count()}}
                        </span>
                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/driver/history/delivery">
                        <i class="nav-icon fe fe-book me-2"></i> Delivery History
                    </a>
                </li>

            </ul>

        </div>
    </nav>



@endif



