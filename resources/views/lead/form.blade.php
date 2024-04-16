
<div class="row">
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.first_name') : </label>
            <input type="text" class="form-control" name="name" id="name" value="{{ isset($lead) ? $lead->name : old('name') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.last_name') : </label>
            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ isset($lead) ? $lead->last_name : old('last_name') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.identification_type') : </label>
            <select class="form-control" name="identification_type" id="identification_type">
                <option value="" disabled {{ !isset($lead) ? 'selected' : '' }}>@lang('cruds.lead.fields.select_identification_type')</option>
                @foreach(config('constants.identification_type') as $key => $value)
                <option value="{{ $key }}" {{ isset($lead) && $lead->identification_type == $key ? 'selected' : '' }}>{{ trans('cruds.identification_type.'.$value) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-12 {{ isset($lead) && !is_null($lead->identification) ? '' : 'd-none' }}" id="identificationField">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.identification') : </label>
            <input type="text" class="form-control" name="identification" id="identification" value="{{ isset($lead) ? $lead->identification : old('identification') }}" autocomplete="off"  maxlength="" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.birth_date') : </label>
            <input type="text" class="form-control" name="birthdate" id="birthdate" value="{{ isset($lead) ? $lead->birthdate : old('birthdate') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.gender') : </label>
            <select class="form-control" name="gender" id="gender">
                <option value="" disabled {{ !isset($lead) ? 'selected' : '' }}>@lang('cruds.lead.fields.select_gender')</option>
                @foreach(config('constants.genders') as $key => $value)
                <option value="{{ $key }}" {{ isset($lead) && $lead->gender == $key ? 'selected' : '' }}>{{ ucfirst(trans('cruds.genders.'.$value)) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.civil_status') : </label>
            <select class="form-control" name="civil_status" id="civil_status">
                <option value="" disabled {{ !isset($lead) ? 'selected' : '' }}>@lang('cruds.lead.fields.select_civil_status')</option>
                @foreach(config('constants.civil_status') as $key => $value)
                <option value="{{ $key }}" {{ isset($lead) && $lead->civil_status == $key ? 'selected' : '' }}>{{ ucfirst(trans('cruds.civil_status.'.$value)) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.phone') : </label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{ isset($lead) ? $lead->phone : old('phone') }}" autocomplete="off" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.cell_phone') : </label>
            <input type="text" class="form-control" name="cellphone" id="cellphone" value="{{ isset($lead) ? $lead->cellphone : old('cellphone') }}" autocomplete="off" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.email') : </label>
            <input type="email" class="form-control" name="email" id="email" value="{{ isset($lead) ? $lead->email : old('email') }}" autocomplete="off" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.province') : </label>
            <input type="text" class="form-control" name="province" id="province" value="{{ isset($lead) ? $lead->province : old('province') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.city') : </label>
            <input type="text" class="form-control" name="city" id="city" value="{{ isset($lead) ? $lead->city : old('city') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.address') : </label>
            <input type="text" class="form-control" name="address" id="address" value="{{ isset($lead) ? $lead->address : old('address') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.sector') : </label>
            <input type="text" class="form-control" name="sector" id="sector" value="{{ isset($lead) ? $lead->sector : old('sector') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.reference') : </label>
            <input type="text" class="form-control" name="reference" id="reference" value="{{ isset($lead) ? $lead->reference : old('reference') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.employment_status') : </label>
            <select class="form-control" name="employment_status" id="employment_status">
                <option value="" disabled {{ !isset($lead) ? 'selected' : '' }}>@lang('cruds.lead.fields.select_emp_status')</option>
                @foreach(config('constants.employment_status') as $key => $value)
                <option value="{{ $key }}" {{ isset($lead) && $lead->employment_status == $key ? 'selected' : '' }}>{{ ucfirst(trans('cruds.employment_status.'.$value)) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.social_security') : </label>
            <select class="form-control" name="social_security" id="social_security">
                <option value="" disabled {{ !isset($lead) ? 'selected' : '' }}>@lang('cruds.lead.fields.select_social_security')</option>
                @foreach(config('constants.social_securities') as $key => $value)
                <option value="{{ $key }}" {{ isset($lead) && $lead->social_security == $key ? 'selected' : '' }}>{{ ucfirst(trans('cruds.social_securities.'.$value)) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.company_name') : </label>
            <input type="text" class="form-control" name="company_name" id="company_name" value="{{ isset($lead) ? $lead->company_name : old('company_name') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.occupation') : </label>
            <input type="text" class="form-control" name="occupation" id="occupation" value="{{ isset($lead) ? $lead->occupation : old('occupation') }}" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.campaign') :</label>
            <select class="form-control" name="campaign_id" id="campaign_id">
                <option value="" disabled {{ !isset($lead) ? 'selected' : '' }}>@lang('cruds.lead.fields.select_campaign')</option>
                @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->id }}" {{ isset($lead) && $lead->campaign_id == $campaign->id ? 'selected' : '' }}>
                        {{ $campaign->campaign_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.area') :</label>

            <select class="form-control" name="area_id" id="area_id">
                <option value="">{{ trans('cruds.lead.fields.select_area') }}</option>

                @if(isset($lead))
                    @foreach($lead->campaign->areas as $area)

                    <option value="{{ isset($lead) ? $lead->area_id : "" }}" {{ $area->id == $lead->area_id ? 'selected' : '' }}>
                        {{ ucwords($area->area_name) }}
                    </option>

                    @endforeach
                @endif

            </select>
        </div>
    </div>

    <div class="col-12 col-lg-4">
    </div>

    <div class="col">
        <div class="buttonform">
            <button type="button" class="btn btn-red btnsmall" id="CancelFormBtn">{{__('global.cancel')}}</button>
        </div>
    </div>
    <div class="col-auto">
        <div class="buttonform text-end">
            <button type="submit" class="btn btn-green btnsmall">{{ isset($lead) ? __('global.update') : __('global.save')}}</button>
        </div>
    </div>
</div>


