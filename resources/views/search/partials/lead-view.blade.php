@if($lead)

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.first_name'):</label>
        <div class="dataitem">{{ $lead->name ? ucfirst($lead->name) : '' }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.last_name'):</label>
        <div class="dataitem">{{ $lead->last_name ? ucfirst($lead->last_name) : '' }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.identification'):</label>
        <div class="dataitem">{{ $lead->identification ?? '' }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.birth_date'):</label>
        <div class="dataitem">{{ $lead->birthdate ?? '' }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.gender'):</label>
        <div class="dataitem">{{ isset(config('constants.genders')[$lead->gender]) ? ucfirst(trans('cruds.genders.'.config('constants.genders')[$lead->gender]) ) :''  }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.civil_status'):</label>
        <div class="dataitem">{{ isset(config('constants.civil_status')[$lead->civil_status]) ? ucfirst(trans('cruds.civil_status.'.config('constants.civil_status')[$lead->civil_status]) ) :''  }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.phone'):</label>
        <div class="dataitem">{{ $lead->phone ?? '' }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.cell_phone'):</label>
        <div class="dataitem">{{ $lead->cellphone ?? '' }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.email'):</label>
        <div class="dataitem">{{ $lead->email ?? '' }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.province'):</label>
        <div class="dataitem">{{ $lead->province ? ucwords($lead->province) :'' }}</div>
    </div>
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.city'):</label>
        <div class="dataitem">{{ $lead->city ? ucwords($lead->city) : '' }}</div>
    </div>

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.address'):</label>
        <div class="dataitem">{{ $lead->address ? ucwords($lead->address) : '' }}</div>
    </div>
    
    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.sector'):</label>
        <div class="dataitem">{{ $lead->sector ? ucwords($lead->sector) : '' }}</div>
    </div>

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.reference'):</label>
        <div class="dataitem">{{ $lead->reference ? ucwords($lead->reference) : '' }}</div>
    </div>

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.employment_status'):</label>
        <div class="dataitem">{{ isset(config('constants.employment_status')[$lead->employment_status]) ? ucfirst(trans('cruds.employment_status.'.config('constants.employment_status')[$lead->employment_status]) ) :''  }}</div>
    </div>

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.social_security'):</label>
        <div class="dataitem">{{ isset(config('constants.social_securities')[$lead->social_security]) ? ucfirst(trans('cruds.social_securities.'.config('constants.social_securities')[$lead->social_security]) ) :''  }}</div>
    </div>

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.company_name'):</label>
        <div class="dataitem">{{ $lead->company_name ? ucwords($lead->company_name) : '' }}</div>
    </div>

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.occupation'):</label>
        <div class="dataitem">{{ $lead->occupation ? ucwords($lead->occupation) : '' }}</div>
    </div>

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.campaign'):</label>
        <div class="dataitem">{{ $lead->campaign ? ucwords($lead->campaign->campaign_name) : '' }}</div>
    </div>

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.area'):</label>
        <div class="dataitem">{{ $lead->area ? ucwords($lead->area->area_name) : '' }}</div>
    </div>

    <div class="datablockitem">
        <label>@lang('cruds.lead.fields.created_by'):</label>
        <div class="dataitem">{{ $lead->createdBy ? ucwords($lead->createdBy->name) : '' }}</div>
    </div>

@endif