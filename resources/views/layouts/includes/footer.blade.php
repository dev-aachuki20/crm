<footer>
    <div class="container">
        <div class="footer-links">
            <ul class="list-unstyled mb-0">
                <li><a href="{{route('channels',['lang' => app()->getLocale()])}}">{{__('cruds.channel.title_singular')}}</a></li>
                <li><a href="{{route('campaigns',['lang' => app()->getLocale()])}}">{{__('cruds.campaign.title')}}</a></li>
                <li><a href="{{route('interactions',['lang' => app()->getLocale()])}}">{{__('cruds.interaction.title_singular')}}</a></li>
                <li><a href="{{route('users',['lang' => app()->getLocale()])}}">{{__('cruds.user.title')}}</a></li>
                <li><a href="{{route('leads',['lang' => app()->getLocale()])}}">{{__('cruds.lead.title')}}</a></li>
            </ul>
        </div>
    </div>
</footer>