@extends('layouts.master')
@section('title', 'Profile')

@push('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

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
                    <input id="email" type="email" name="email" value="{{ $userDetail->email }}" class="form-control @error('email') is-invalid @enderror" readonly />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-0">
                    <label>{{__('cruds.user.fields.birthdate')}}:</label>
                    <input type="text" name="birthdate" id="birthdate" value="{{ $userDetail->birthdate ? \Carbon\Carbon::parse($userDetail->birthdate)->format('Y-m-d') : \Carbon\Carbon::now()->subDay()->format('Y-m-d') }}" class="form-control @error('birthdate') is-invalid @enderror" readonly/>
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
                    <input type="text" id="username" name="username" value="{{ $userDetail->username }}" class="form-control" readonly />
                </div>

                <div class="form-group">
                    <label>{{__('cruds.user.fields.role')}}:</label>
                    @if($roles)
                    <input id="roleofuser" type="text" value="{{ $roles->title }}" class="form-control" readonly />
                    @endif
                </div>

                <div class="form-group @error('password') invalidGroup @enderror">
                    <label>{{__('cruds.user.fields.password')}}:</label>
                    <input type="password" name="password" id="password" class="form-control password @error('password') is-invalid @enderror" autocomplete="off" />
                    <span toggle="#password-field" class="form-icon-password toggle-password" style="top: 45px;"><img src="{{asset('images/view.svg')}}" class="img-fluid" /></span>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-0 @error('password_confirmation') invalidGroup @enderror">
                    <label>{{__('cruds.user.fields.repeat_password')}}:</label>
                    <input type="password" name="password_confirmation" id="password_confirm" class="form-control password @error('password_confirmation') is-invalid @enderror" autocomplete="off"/>
                    <span toggle="#password-field" class="form-icon-password toggle-password" style="top: 45px;"><img src="{{asset('images/view.svg')}}" class="img-fluid" /></span>
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group mb-lg-0">
                    <label>{{ __('cruds.campaign.title_singular') }}:</label>
                    <input type="hidden" name="campaign" class="form-control" value="" id="campaign">
                    <div class="listbox-wrapper campaign-listing ban-element">
                        <div class="listbox">
                            @forelse($allCampaign as $campaign)
                            <div class="checboxcont">
                                {{-- <input type="checkbox" name="campaign[]" class="form-control" value="{{$campaign->id}}" @if(in_array($campaign->id, $userCampaigns))
                                checked
                                @endif> --}}
                                <span class="custom-check {{ in_array($campaign->id, $userCampaigns) ? 'checked' : ''}}"></span>
                                <span>{{$campaign->campaign_name}}</span>
                            </div>
                            @empty
                            <div class="checboxcont">
                                <span>Data Not Found!</span>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    {{-- @error('campaign')
                    <span style="color:red;">
                        {{ $message }}
                    </span>
                    @enderror --}}
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);

        var dobval = $('#birthdate').val();
            
        $('#birthdate').daterangepicker({
            autoApply: true,
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            maxDate: yesterday,
            startDate: dobval,
            locale: {
                format: 'YYYY-MM-DD'
            },
        },
        function(start, end, label) {
            $('#birthdate').val(start.format('YYYY-MM-DD'));
        });
            
        $('.file-input').change(function() {
            var curElement = $('.image');
            console.log(curElement);
            var reader = new FileReader();

            reader.onload = function(e) {
                curElement.attr('src', e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        });
    });

    $(document).on('click', '.toggle-password', function() {

        var $this = $(this);

        if ($this.siblings('.password ').is(':disabled') == false) {
            $this.toggleClass("eye-open");

            var elementId = $this.siblings('input').attr('id');
            var input = $('#'+elementId);

            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password');
        }

    });

    $(document).ready(function() {
        if (@json($errors->any())) {
            $("#updateProfileForm :input").prop("disabled", false);
            $("#saveButton").prop("disabled", false);
            $("#cancelButton").prop("disabled", false);
            $("#editButton").prop("disabled", true);

        } else {
            $("#updateProfileForm :input").prop("disabled", true);
            $("#saveButton").prop("disabled", true);
            $("#cancelButton").prop("disabled", true);

            $("#editButton").on("click", function() {

                $(this).prop("disabled", true);
                
                $("#updateProfileForm :input").prop("disabled", false);
                $("#saveButton").prop("disabled", false);
                $("#cancelButton").prop("disabled", false);
            });
        }
    });

    document.getElementById('cancelButton').addEventListener('click', function() {
        var cancelUrl = this.getAttribute('data-url');
        window.location.href = cancelUrl;
    });
</script>
@endpush