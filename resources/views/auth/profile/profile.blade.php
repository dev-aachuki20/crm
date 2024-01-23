@extends('layouts.master')

<!-- MAIN BLOCK START -->
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
                    <button type="button" class="btn btn-edit btnsmall">{{__('cruds.edit')}}</button>
                    <button type="submit" form="updateProfileForm" class="btn btn-save btnsmall">{{__('cruds.save')}}</button>
                    <button type="button" class="btn btn-cancle btnsmall">{{__('cruds.cancel')}}</button>
                </div>
            </div>
        </div>
    </div>
    <form id="updateProfileForm" class="wrapperblock mt-3" method="POST" action="{{ route('updateProfile') }}">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="upload-photo">
                    <div class="containers">
                        <div class="imageWrapper">
                            <img class="image" src="{{asset('images/man.png')}}" class="img-fluid" />
                        </div>
                    </div>
                    <h5 class="mt-3">Profile avatar</h5>
                    <button class="file-upload">
                        <input type="file" class="file-input">Upload photo
                    </button>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" value="{{ $userDetail->name }}" class="form-control" />
                </div>
                <!--  -->
                <div class="form-group">
                    <label>Last name:</label>
                    <input type="text" name="last_name" value="{{ $userDetail->last_name }}" class="form-control" />
                </div>
                <!--  -->
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" value="{{ $userDetail->email }}" class="form-control" />
                </div>
                <!--  -->
                <div class="form-group mb-0">
                    <label>Birthdate:</label>
                    <input type="date" name="birthdate" value="{{ $userDetail->birthdate }}" class="form-control" />
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" value="{{ $userDetail->username }}" class="form-control" />
                </div>
                <!--  -->
                <div class="form-group">
                    <label>Rol:</label>
                    <select class="form-control">
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->title }}</option>
                        @endforeach
                    </select>
                </div>
                <!--  -->
                <div class="form-group">
                    <label>password:</label>
                    <input type="password" name="password" class="form-control" />
                </div>
                <!--  -->
                <div class="form-group mb-0">
                    <label>Repeat password:</label>
                    <input type="password" name="password_confirmation" class="form-control" />
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <label>Campaign:</label>
                    <div class="listbox">
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>Black Friday</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>Navidad</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>SIN IVA</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>Regreso a Clases</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>Black Friday</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>Navidad</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>SIN IVA</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>Regreso a Clases</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>Black Friday</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>Navidad</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>SIN IVA</span>
                        </div>
                        <div class="checboxcont">
                            <input type="checkbox" name="campaign" class="form-control">
                            <span>Regreso a Clases</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
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
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
<!-- MAIN BLOCK END -->

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
</script>
@endpush