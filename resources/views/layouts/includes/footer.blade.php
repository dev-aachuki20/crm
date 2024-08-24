<footer class="footer {{ auth()->user()->is_vendor ? 'menu-space' : ''}}">
    <div class="container">
        <div class="footer-links">
            <div class="mobile_footer_header row d-md-none d-flex">
                <div class="col"><a href="" class="logo"><img src="{{asset('images/gestiona.svg')}}" class="img-fluid"></a></div>
                <div class="col-auto"><button type="button" class="btn closebtn d-md-none d-flex"><img src="{{asset('images/close.svg')}}"></button></div>
            </div>
            <ul class="list-unstyled mb-0">
                @can('area_access')
                <li><a href="{{route('areas',['lang' => app()->getLocale()])}}">{{__('cruds.area.title')}}</a></li>
                @endcan

                @can('compaign_access')
                <li><a href="{{route('campaigns',['lang' => app()->getLocale()])}}">{{__('cruds.campaign.title')}}</a></li>
                @endcan

                <li><a href="{{ route('interactions',['lang' => app()->getLocale()]) }}">{{__('cruds.interaction.title')}}</a></li>

                @can('user_access')
                <li><a href="{{route('users',['lang' => app()->getLocale()])}}">{{__('cruds.user.title')}}</a></li>
                @endcan

                @can('leads_access')
                <li><a href="{{route('leads',['lang' => app()->getLocale()])}}">{{__('cruds.lead.title')}}</a></li>
                @endcan
            </ul>
        </div>
    </div>
</footer>
