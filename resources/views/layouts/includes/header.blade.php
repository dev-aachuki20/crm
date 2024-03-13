<header>
    <div class="container-fluid">
        <div class="header-main">
            <div class="row align-items-center">
                @if (request()->route()->getName() !== 'home')
                <div class="col-md-3 col">
                    <div class="header-main-left">
                        <a href="{{route('home',['lang'=> app()->getLocale()])}}" class="logo"><img src="{{asset('images/gestiona.svg')}}" class="img-fluid" /></a>
                    </div>
                </div>
                @endif
                @if (request()->route()->getName() !== 'home')
                <div class="col-xl-6 col-md mt-md-0 mt-2 order-md-2 order-3">
                    <div class="searchaGroup">
                        <button type="button" class="btn toggleBtn d-md-none d-flex"><img src="{{asset('images/menu.svg')}}"></button>
                        <form id="makeSearch">
                            @csrf
                            <div class="inputWrapper position-relative">
                                <input id="search" type="text" name="search" class="form-control" value="{{ $lead->identification ?? '' }}" placeholder="{{__('cruds.search_by_identification')}}"  autocomplete="off"/>
                                <button type="button" class="ajax-click clear-search"><img src="{{asset('images/close-wocircle.svg')}}" class="img-fluid" /></button>
                                <button type="submit" class="search"><img src="{{asset('images/search.svg')}}" class="img-fluid" /></button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                <div class="{{ (request()->route()->getName() !== 'home') ? 'd-none' : 'col d-block' }}">
                    <div class="searchaGroup">
                        <button type="button" class="btn toggleBtn small d-md-none d-flex"><img src="{{asset('images/menu.svg')}}"></button>
                    </div>
                </div>
                <div class="{{ (request()->route()->getName() !== 'home') ? 'col-xl-3 col-auto order-md-3 order-2' : 'col-auto ms-auto' }}">
                    <ul class="d-flex justify-content-end align-items-center">
                        <li>
                            <div class="select_area">
                                <select class="niceCountryInputSelector from_code form-control" id="from_code" name="from_country" value="" {{-- onchange="myFunction()" --}}>
                                    <option value="en" data-src="{{asset('images/flags/us.png')}}" @if(\Session::get('userLanguage')==='en' ) selected @endif>EN</option>
                                    <option value="es" data-src="{{asset('images/flags/AS.png')}}" @if(\Session::get('userLanguage')==='es' ) selected @endif>ES</option>
                                </select>
                            </div>
                        </li>
                        <li><button type="button" class="headerbtn"><img src="{{ asset('images/setting.svg') }}"></button></li>
                        <li><button type="button" class="headerbtn"><img src="{{ asset('images/notification.svg') }}"></button></li>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle userimg" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{Auth::user()->profile_image_url ? Auth::user()->profile_image_url : asset('images/man.png')}}"></button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('profile', ['lang' => app()->getLocale()]) }}">{{__('global.profile')}}</a></li>
                                {{-- <li><a href="{{ route('logout', ['lang' => app()->getLocale()]) }}" class="dropdown-item" href="#">{{__('global.logout')}}</a> --}}
                                <li>
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{__('global.logout')}}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
       
        var storedLanguage = localStorage.getItem('userLanguage');

        if (storedLanguage) {
            $('#from_code').val(storedLanguage);
        }

        $('#from_code').change(function() {
            var selectedLanguage = $(this).val() ?? 'en';
            localStorage.setItem('userLanguage', selectedLanguage);

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.post('/update-language', {
                language: selectedLanguage
            }, function(data) {
                location.reload();
            });
        });
     
    });
</script>