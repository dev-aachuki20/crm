<header>
    <div class="container-fluid">
        <div class="header-main">
            <div class="row align-items-center">
                <div class="col-12 col-lg-3">
                    @if (request()->route()->getName() !== 'home')
                    <div class="header-main-left">
                        <a href="{{route('home',['lang'=> app()->getLocale()])}}" class="logo"><img src="{{asset('images/gestiona.svg')}}" class="img-fluid" /></a>
                    </div>
                    @endif
                </div>
                <div class="col-12 col-lg-6">
                    @if (request()->route()->getName() !== 'home')
                    <form>
                        <div class="inputWrapper position-relative">
                            <input id="search" type="search" name="" class="form-control" placeholder="{{__('cruds.search_id')}}" />
                            <button type="button" class="search"><img src="{{asset('images/search.svg')}}" class="img-fluid" /></button>
                        </div>
                    </form>
                    @endif
                </div>
                <div class="col-12 col-lg-3">
                    <ul class="d-flex justify-content-end align-items-center">
                        <li><button type="button" class="headerbtn"><img src="{{ asset('images/setting.svg') }}"></button></li>
                        <li><button type="button" class="headerbtn"><img src="{{ asset('images/notification.svg') }}"></button></li>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle userimg" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{Auth::user() ? Auth::user()->profile_image_url : asset('images/man.png')}}"></button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('profile', ['lang' => app()->getLocale()]) }}">{{__('global.profile')}}</a></li>
                                <li><a href="{{ route('logout', ['lang' => app()->getLocale()]) }}" class="dropdown-item" href="#">{{__('global.logout')}}</a>
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