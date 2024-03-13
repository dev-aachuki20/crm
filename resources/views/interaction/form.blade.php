<div class="row">
    <input type="hidden" name="lead_id" value="{{ isset($lead->uuid) ? $lead->uuid : '' }}">
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.interaction.fields.registration_date'):</label>
            <input type="text" name="registration_at" id="registration_at" class="form-control" value="{{ isset($interaction) ? \Carbon\Carbon::parse($interaction->registration_at)->format('Y-m-d H:i') : ''  }}"  disabled />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.interaction.fields.identification'):</label>
            <input type="text" name="identification" class="form-control" value="{{ isset($lead->identification) ? $lead->identification : old('identification') }}" disabled/>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.interaction.fields.phone'):</label>
            <input type="text" name="phone" class="form-control" value="{{ isset($lead->phone) ? $lead->phone : old('phone') }}" disabled />
        </div>
    </div>
    <div class="col-12 col-lg-3">
        <div class="form-group">
            <label>@lang('cruds.interaction.fields.campaign'):</label>
            <input type="text" name="campaign" class="form-control" value="{{ isset($lead->campaign) ? $lead->campaign->campaign_name : old('campaign') }}" disabled />
        </div>
    </div>
    <div class="col-12 col-lg-3">
        <div class="form-group">
            <label>@lang('cruds.interaction.fields.area'):</label>
            <input type="text" name="area" class="form-control" value="{{ isset($lead->area) ? $lead->area->area_name : old('area') }}" disabled  >
        </div>
    </div>
    <div class="col-12 col-lg-12">
        <div class="form-group">
            <label>@lang('cruds.interaction.fields.qualification'):</label>
            @php
                $qualifications = null;
                if($lead->campaign){
                    $qualifications = $lead->campaign->tagLists ? json_decode($lead->campaign->tagLists->tag_name,true) : null;
                }
            @endphp
            <select class="form-control" name="qualification">
                <option>@lang('global.select') @lang('cruds.interaction.fields.qualification')</option>

                @if($qualifications)

                    @foreach ($qualifications as $val)
                        <option  value="{{$val}}" {{ isset($interaction->qualification) ? ($interaction->qualification  == $val ? 'selected' : '') : '' }}>{{ ucwords($val) }}</option>
                    @endforeach
                    
                @endif
                
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-12">
        <div class="form-group">
            <label>@lang('cruds.interaction.fields.customer_observation'):</label>
            <textarea class="form-control" name="customer_observation">{{ isset($interaction->customer_observation) ? $interaction->customer_observation : old('customer_observation') }}</textarea>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="buttonform">
            <button type="button" class="btn btn-red btnsmall" id="CancelFormBtn">{{__('global.cancel')}}</button>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="buttonform text-end">
            <button type="submit" class="btn btn-green btnsmall">{{__('global.save')}}</button>
        </div>
    </div>
</div>