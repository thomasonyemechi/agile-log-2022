<div class="header">
    <!-- navbar -->
    <nav class="navbar-default navbar navbar-expand-lg">
        <a id="nav-toggle" href="#">
            <i class="fe fe-menu"></i>
        </a>
        <div class="ms-lg-3 d-none d-md-none d-lg-block">
            <!-- Form -->
            @if (auth()->user()->role > 1)
                <form method="post" action="/control/collectsearch" class="d-flex align-items-center">@csrf
                    <span class="position-absolute ps-3 search-icon">
                        <i class="fe fe-search"></i>
                    </span>
                    <input type="search" name="q" class="form-control form-control-sm ps-6" placeholder="Search Entire Freight" />
                </form>
            @endif
        </div>
        <!--Navbar nav -->
        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
            <!-- List -->
            <li class="dropdown ms-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <img alt="avatar" src="{{ asset('assets/img/user/'.auth()->user()->img) }}" class="rounded-circle" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                    <div class="dropdown-item">
                        <div class="d-flex">
                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                <img alt="avatar" src="{{ asset('assets/img/user/'.auth()->user()->img) }}" class="rounded-circle" />
                            </div>
                            <div class="ms-3 lh-1">
                                <h5 class="mb-1"> {{ucwords(auth()->user()->name)}} </h5>
                                <p class="mb-0 text-muted">{{auth()->user()->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    @if (auth()->user()->role > 1)
                        <ul class="list-unstyled">
                            <li>
                                <a class="dropdown-item" href="/control/organizations/all">
                                    <i class="fe fe-users me-2"></i> All Organizations
                                </a>
                            </li>
                        </ul>
                    @endif
                    <div class="dropdown-divider"></div>
                    <ul class="list-unstyled">
                        <li>
                            <a class="dropdown-item" href="/logout">
                                <i class="fe fe-power me-2"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</div>
