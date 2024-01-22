<header>
    <div class="container-fluid">
        <div class="header-main">
            <div class="row align-items-center">
                <div class="col-12 col-lg-3">
                    @if (request()->route()->getName() === 'profile')
                        <div class="header-main-left">
                            <a href="" class="logo"><img src="images/gestiona.svg" class="img-fluid" /></a>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-lg-6">
                    @if (request()->route()->getName() === 'profile')
                        <form>
                            <div class="inputWrapper position-relative">
                                <input id="search" type="search" name="" class="form-control"
                                    placeholder="Search the ID" />
                                <button type="button" class="search"><img src="images/search.svg"
                                        class="img-fluid" /></button>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="col-12 col-lg-3">
                    <ul class="d-flex justify-content-end align-items-center">
                        <li><button type="button" class="headerbtn"><img
                                    src="{{ asset('images/setting.svg') }}"></button></li>
                        <li><button type="button" class="headerbtn"><img
                                    src="{{ asset('images/notification.svg') }}"></button></li>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle userimg" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img
                                    src="{{ asset('images/man.png') }}"></button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li><a href="{{ route('logout') }}" class="dropdown-item" href="#">Logout</a>
                                </li>
                            </ul>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
