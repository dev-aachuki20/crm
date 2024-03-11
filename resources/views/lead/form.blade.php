<input type="hidden" id="lead-id" name="lead_id" value="">
<div class="row">
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" class="form-control" name="first_name" id="first_name" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" class="form-control" name="last_name" id="last_name" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Identification:</label>
            <input type="text" class="form-control" name="identification" id="identification" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Birthdate:</label>
            <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="DOB" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Sex:</label>
            <select class="form-control" name="gender" id="gender">
                @foreach(config('constants.genders') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Civil status:</label>
            <select class="form-control" name="civil_status" id="civil_status">
                @foreach(config('constants.civil_status') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Phone:</label>
            <input type="text" class="form-control" name="phone" id="phone" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Cellphone:</label>
            <input type="text" class="form-control" name="cellphone" id="cellphone" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" id="email" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Province:</label>
            <input type="text" class="form-control" name="province" id="province" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>City:</label>
            <input type="text" class="form-control" name="city" id="city" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Street address / Intersection:</label>
            <input type="text" class="form-control" name="address" id="address" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Sector:</label>
            <input type="text" class="form-control" name="sector" id="sector" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Reference:</label>
            <input type="text" class="form-control" name="reference" id="reference" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Employment status:</label>
            <select class="form-control" name="employment_status" id="employment_status">
                @foreach(config('constants.employment_status') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Social security:</label>
            <select class="form-control" name="social_securities" id="social_securities">
                @foreach(config('constants.social_securities') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Company name:</label>
            <input type="text" class="form-control" name="company_name" id="company_name" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Ocupation:</label>
            <input type="text" class="form-control" name="occupation" id="occupation" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Assign to:</label>
            <input type="text" class="form-control" />
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Channel:</label>
            <select class="form-control" name="area" id="area">
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="form-group">
            <label>Campaign:</label>
            <select class="form-control" name="campaign" id="campaign">
                @foreach($campaigns as $campaign)
                <option value="{{ $campaign->id }}">{{ $campaign->campaign_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="form-group">
            <label>Qualification:</label>
            <select class="form-control" name="qualification" id="qualification">
                @foreach($qualificationTagList as $qualification)
                <option value="{{ $qualification->id }}">{{ is_array($decoded = json_decode($qualification->tag_name, true)) ? reset($decoded) : $qualification->tag_name }}</option>
                @endforeach
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