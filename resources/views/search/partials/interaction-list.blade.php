@if($interactions->count() > 0)

    @foreach($interactions as $key=>$interaction)

        <div class="datablock-observation">
            <div class="row gx-2 pt-1">
                <div class="col-sm-auto mb-sm-0 mb-4">
                    <div class="dategroup nestingdate">
                        <span class="month">{{ \Carbon\Carbon::parse($interaction->registration_at)->format('F') }}</span>
                        <span class="date">{{ \Carbon\Carbon::parse($interaction->registration_at)->format('d') }}</span>
                        <span class="year">{{ \Carbon\Carbon::parse($interaction->registration_at)->format('Y') }}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="datecontentside">
                        <h6>
                            {{ $interaction->lead->identification }} / {{ \Carbon\Carbon::parse($interaction->registration_at)->format('h:i A') }}
                        </h6>
                        <p class="content"> {{ nl2br($interaction->customer_observation) }} </p>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

@endif
