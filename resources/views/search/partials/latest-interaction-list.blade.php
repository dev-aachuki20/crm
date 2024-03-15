@if($lead->interactions()->count() > 0)

<h6>
    {{ $lead->identification }} / {{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('d-m-Y') }} / {{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('H') }}h{{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('i') }}
</h6>
<p>
    {{ nl2br($latestInteractions->customer_observation) }}
</p>
<ul class="mb-0 list-unstyled">
    <li>@lang('cruds.interaction.title'): <span>{{ $lead->interactions()->count() }}</span></li>
    <li>@lang('cruds.interaction.fields.campaign'): <span>{{ isset($lead->campaign) ? $lead->campaign->campaign_name :'' }}</span></li>
    <li>@lang('cruds.interaction.fields.area'): <span>{{ isset($lead->area) ? $lead->area->area_name : '' }}</span></li>
    <li>@lang('cruds.interaction.fields.created_by'): <span>{{ $lead->createdBy->name }}</span></li>
</ul>
@endif