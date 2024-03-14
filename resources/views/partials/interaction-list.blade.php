@if($interactions->count() > 0)

    @foreach($interactions as $key=>$interaction)

        <div class="datablock-observation">
            <h6>
                {{ $interaction->lead->identification }} / {{ \Carbon\Carbon::parse($interaction->registration_at)->format('d-m-Y') }} / {{ \Carbon\Carbon::parse($interaction->registration_at)->format('H') }}h{{ \Carbon\Carbon::parse($interaction->registration_at)->format('i') }}
            </h6>
            <p> {{ nl2br($interaction->customer_observation) }} </p>
        </div>

    @endforeach
  
@endif