<footer class="footer">
    <div class="container">
        <div class="footer-links">
            <div class="mobile_footer_header row d-md-none d-flex">
                <div class="col"><a href="" class="logo"><img src="{{asset('images/gestiona.svg')}}" class="img-fluid"></a></div>
                <div class="col-auto"><button type="button" class="btn closebtn d-md-none d-flex"><img src="{{asset('images/close.svg')}}"></button></div>
            </div>
            <ul class="list-unstyled mb-0">
                <li><a href="{{route('channels',['lang' => app()->getLocale()])}}">{{__('cruds.channel.title')}}</a></li>
                <li><a href="{{route('campaigns',['lang' => app()->getLocale()])}}">{{__('cruds.campaign.title')}}</a></li>
                <li><a href="javascript:void(0);">{{__('cruds.interaction.title_singular')}}</a></li>

                @can('user_access')
                    <li><a href="{{route('users',['lang' => app()->getLocale()])}}">{{__('cruds.user.title')}}</a></li>
                @endcan

                <li><a href="javascript:void(0);">{{__('cruds.lead.title')}}</a></li>
            </ul>
        </div>
    </div>
</footer>