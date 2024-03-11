<input type="hidden" id="lead-id" name="lead_id" value="">
<div class="row">
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.first_name') : </label>
            <input type="text" class="form-control" name="first_name" id="first_name" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.last_name') : </label>
            <input type="text" class="form-control" name="last_name" id="last_name" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.identification') : </label>
            <input type="text" class="form-control" name="identification" id="identification" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.birth_date') : </label>
            <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="DOB" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.gender') : </label>
            <select class="form-control" name="gender" id="gender">
                @foreach(config('constants.genders') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.civil_status') : </label>
            <select class="form-control" name="civil_status" id="civil_status">
                @foreach(config('constants.civil_status') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.phone') : </label>
            <input type="text" class="form-control" name="phone" id="phone" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.cell_phone') : </label>
            <input type="text" class="form-control" name="cellphone" id="cellphone" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.email') : </label>
            <input type="email" class="form-control" name="email" id="email" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.province') : </label>
            <input type="text" class="form-control" name="province" id="province" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.city') : </label>
            <input type="text" class="form-control" name="city" id="city" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.address') : </label>
            <input type="text" class="form-control" name="address" id="address" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.sector') : </label>
            <input type="text" class="form-control" name="sector" id="sector" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.reference') : </label>
            <input type="text" class="form-control" name="reference" id="reference" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.employment_status') : </label>
            <select class="form-control" name="employment_status" id="employment_status">
                @foreach(config('constants.employment_status') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.social_security') : </label>
            <select class="form-control" name="social_securities" id="social_securities">
                @foreach(config('constants.social_securities') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.company_name') : </label>
            <input type="text" class="form-control" name="company_name" id="company_name" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.occupation') : </label>
            <input type="text" class="form-control" name="occupation" id="occupation" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.assign_to') : </label>
            <input type="text" class="form-control" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.campaign') :</label>
            <select class="form-control" name="campaign" id="campaign">
                @foreach($campaigns as $campaign)
                <option value="{{ $campaign->id }}">{{ $campaign->campaign_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>@lang('cruds.lead.fields.area') :</label>
            <select class="form-control" name="area" id="area">
                {{-- @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach --}}
            </select>
        </div>
    </div>


    <div class="col-12 col-lg-6"></div>
    <div class="col">
        <div class="buttonform">
            <button type="button" class="btn btn-red btnsmall">{{__('global.cancel')}}</button>
        </div>
    </div>
    <div class="col-auto">
        <div class="buttonform text-end">
            <button type="submit" class="btn btn-green btnsmall">{{__('global.save')}}</button>
        </div>
    </div>
</div>
