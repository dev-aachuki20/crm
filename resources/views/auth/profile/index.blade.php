@extends('layouts.master')
@section('title', 'Profile')
@section('content')
<div class="container">
    <div class="headingbar">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="headingleft">
                    <h2>{{__('global.profile')}}</h2>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="buttongroup-block d-flex justify-content-end">
                    <button id="editButton" type="button" class="btn btn-blue btnsmall">{{__('cruds.edit')}}</button>
                    <button id="saveButton" type="submit" form="updateProfileForm" class="btn btn-green btnsmall">{{__('cruds.save')}}</button>
                    <button id="cancelButton" type="button" class="btn btn-red btnsmall" data-url="{{ route('profile', ['lang' => app()->getLocale()]) }}">
                        {{ __('cruds.cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <form id="updateProfileForm" class="wrapperblock mt-3" method="POST" action="{{ route('updateProfile',['lang' => app()->getLocale()]) }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="upload-photo">
                    <div class="containers">
                        <div class="imageWrapper">
                            <img class="image" src="{{$userDetail->profile_image_url ? $userDetail->profile_image_url : asset('images/man.png')}}" class="img-fluid" />
                        </div>
                    </div>
                    <h5 class="mt-3">{{ $userDetail->name }}</h5>
                    <button class="file-upload">
                        <input type="file" name="image" class="file-input">{{__('cruds.user.profile.upload_photo')}}
                    </button>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <label>{{__('cruds.user.fields.first_name')}}:</label>
                    <input type="text" name="first_name" value="{{ $userDetail->first_name }}" class="form-control @error('first_name') is-invalid @enderror" />
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('cruds.user.fields.last_name')}}:</label>
                    <input type="text" name="last_name" value="{{ $userDetail->last_name }}" class="form-control @error('last_name') is-invalid @enderror" />
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('cruds.user.fields.email')}}:</label>
                    <input id="email" type="email" name="email" value="{{ $userDetail->email }}" class="form-control @error('email') is-invalid @enderror" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-0">
                    <label>{{__('cruds.user.fields.birthdate')}}:</label>
                    <input type="date" name="birthdate" value="{{ $userDetail->birthdate }}" class="form-control @error('birthdate') is-invalid @enderror" />
                    @error('birthdate')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <label>{{__('cruds.user.fields.user_name')}}:</label>
                    <input type="text" name="username" value="{{ $userDetail->username }}" class="form-control @error('username') is-invalid @enderror" autocomplete="current-password" />
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('cruds.user.fields.role')}}:</label>
                    <select name="role" class="form-control">
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $userDetail->isAssignedRole($role->id) ? 'selected' : '' }}>{{ $role->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{__('cruds.user.fields.password')}}:</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-0">
                    <label>{{__('cruds.user.fields.repeat_password')}}:</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" />
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <label>{{ __('cruds.campaign.title_singular') }}:</label>
                    <div class="listbox-wrapper">
                        <div class="listbox">
                            @forelse($allCampaign as $campaign)
                                <div class="checboxcont">
                                    <input type="checkbox" name="campaign[]" class="form-control" value="{{$campaign->id}}" 
                                    @if(in_array($campaign->id, explode(',', $userDetail->campaign_id)))
                                        checked 
                                    @endif>
                                    <span>{{$campaign->campaign_name}}</span>
                                </div>    
                            @empty
                                <div class="checboxcont">
                                    <span>Data Not Found!</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
									<label>Channel:</label>
									<div class="listbox">
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Call Center</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Web</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Whatsapp</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Freelance</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Call Center</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Web</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Whatsapp</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Freelance</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Call Center</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Web</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Whatsapp</span>
										</div>
										<div class="checboxcont">
											<input type="checkbox" name="channel" class="form-control">
											<span>Freelance</span>
										</div>
									</div>
								</div> -->
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.file-input').change(function() {
            var curElement = $('.image');
            console.log(curElement);
            var reader = new FileReader();

            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                curElement.attr('src', e.target.result);
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    });

    $(document).ready(function() {
        $("#updateProfileForm :input").prop("disabled", true);
        $("#saveButton").prop("disabled", true);
        $("#cancelButton").prop("disabled", true);

        $("#editButton").on("click", function() {
            $("#updateProfileForm :input").prop("disabled", false);
            $("#email").prop("disabled", true);
            $("#saveButton").prop("disabled", false);
            $("#cancelButton").prop("disabled", false);

        });
    });

    document.getElementById('cancelButton').addEventListener('click', function() {
        var cancelUrl = this.getAttribute('data-url');
        window.location.href = cancelUrl;
    });
</script>
@endpush