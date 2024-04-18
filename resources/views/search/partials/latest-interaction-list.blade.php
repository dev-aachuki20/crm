@if($lead->interactions()->count() > 0)

<div class="row gx-2">
    <div class="col-sm-auto mb-sm-0 mb-4">
        <div class="dategroup">
            <span class="month">{{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('F') }}</span>
            <span class="date">{{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('d') }}</span>
            <span class="year">{{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('Y') }}</span>
        </div>
    </div>
    <div class="col">
        <div class="datecontentside">
            <div class="">
                <h6 class="d-flex flex-md-row flex-column gap-2 justify-content-md-between">
                    {{ $lead->identification }} / {{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('h:i A') }}
                    <div class="buttongroup-block mb-md-0 mb-3">
                        @can('interaction_create')
                        <button type="button" class="btn btn-blue btnsmall addNewInterationBtn" data-href="{{ route('interactions-create', ['uuid' => $lead->uuid]) }}">+ {{__('global.add')}} {{__('cruds.interaction.title_singular')}}</button>
                        @endcan
                    </div>
                </h6>
            </div>
            <p class="content">
                {{ nl2br($latestInteractions->customer_observation) }}
            </p>
            <ul class="mb-0 list-unstyled">
                <li>@lang('cruds.interaction.title'): <span>{{ $lead->interactions()->count() }}</span></li>
                <li>@lang('cruds.interaction.fields.campaign'): <span>{{ isset($lead->campaign) ? $lead->campaign->campaign_name :'' }}</span></li>
                <li>@lang('cruds.interaction.fields.area'): <span>{{ isset($lead->area) ? $lead->area->area_name : '' }}</span></li>
                <li>@lang('cruds.interaction.fields.created_by'): <span>{{ $lead->createdBy->name }}</span></li>
            </ul>
        </div>
    </div>

</div>
@else
<div class="row gx-2">
    <div class="col-sm-auto mb-sm-0 mb-4">
       
    </div>
    <div class="col">
        <div class="datecontentside">
            <div class="dateheader">
                <h6 class="d-flex flex-md-row flex-column gap-2 justify-content-md-between">
                    <p class="m-0"></p>
                    <div class="buttongroup-block mb-md-0 mb-3">

                        @can('interaction_create')
                        <button type="button" class="btn btn-blue btnsmall addNewInterationBtn" data-href="{{ route('interactions-create', ['uuid' => $lead->uuid]) }}">+ {{__('global.add')}} {{__('cruds.interaction.title_singular')}}</button>
                        @endcan

                    </div>
                </h6>
            </div>
            <p class="content">
               
            </p>
            <ul class="mb-0 list-unstyled">
                <li>@lang('cruds.interaction.title'): <span>{{ $lead->interactions()->count() }}</span></li>
                <li>@lang('cruds.interaction.fields.campaign'): <span>{{ isset($lead->campaign) ? $lead->campaign->campaign_name :'' }}</span></li>
                <li>@lang('cruds.interaction.fields.area'): <span>{{ isset($lead->area) ? $lead->area->area_name : '' }}</span></li>
                <li>@lang('cruds.interaction.fields.created_by'): <span>{{ $lead->createdBy->name }}</span></li>
            </ul>
        </div>
    </div>
    
</div>
@endif
