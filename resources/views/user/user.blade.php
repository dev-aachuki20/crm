@extends('layouts.master')
@section('title', 'User')
@section('content')
<div class="container">
    <div class="headingbar">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="headingleft">
                    <h2>{{__('cruds.user.title')}}</h2>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="buttongroup-block d-flex justify-content-end">
                    <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#userstoreModal">+ {{__('global.add')}} {{__('cruds.new')}} {{__('cruds.user.title_singular')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <h4>{{__('cruds.user.title')}} {{__('global.list')}}</h4>
        {!! $dataTable->table(['class' => 'table mb-0']) !!}
    </div>
</div>

<!-- Modal -->
<div class="modal fade new-channel-popup" id="userstoreModal" tabindex="-1" aria-labelledby="userstoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="userstoreModalLabel">{{__('cruds.new_user')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="user-form">
                    @csrf
                    <input type="hidden" id="user-id" name="user_id" value="">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.first_name')}}:</label>
                                        <input type="text" class="form-control" name="first_name" />
                                        @if($errors->has('first_name'))
                                        <span style="color: red;">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.last_name')}}:</label>
                                        <input type="text" class="form-control" name="last_name" />
                                        @if($errors->has('last_name'))
                                        <span style="color: red;">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.user_name')}}:</label>
                                        <input type="text" class="form-control" name="username" />
                                        @if($errors->has('username'))
                                        <span style="color: red;">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.role')}}:</label>
                                        <select class="form-control" name="role" id="user-role">
                                            @foreach($roleData as $role)
                                            <option value="{{ $role->id }}">{{ $role->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.email')}}:</label>
                                        <input type="email" class="form-control" name="email" />
                                        @if($errors->has('email'))
                                        <span style="color: red;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.password')}}:</label>
                                        <input type="password" class="form-control" name="password" />
                                        @if($errors->has('password'))
                                        <span style="color: red;">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.birthdate')}}:</label>
                                        <input type="date" class="form-control" name="birthdate" />
                                        @if($errors->has('birthdate'))
                                        <span style="color: red;">{{ $errors->first('birthdate') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.upload')}}:</label>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group checboxcont">
                                        <input type="checkbox" name="" class="form-control"> {{__('cruds.send_password_to_mail')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>{{__('cruds.campaign.title_singular')}}:</label>
                                <div class="listbox">
                                    @foreach($campaigns as $campaign)
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign_id[]" class="form-control">
                                        <span>{{ucwords($campaign->campaign_name)}}</span>
                                    </div>
                                    @endforeach
                                </div>
                                @if($errors->has('campaign_id'))
                                <span style="color: red;">{{ $errors->first('campaign_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-lg-12">
                            <div class="buttonform">
                                <button type="button" class="btn btn-green btnsmall" onclick="submitForm()">{{__('global.save')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
<script>
    function submitForm() {
        var formData = $('#user-form').serialize();
        var userId = $('#user-id').val();

        var url = (userId) ? "{{ route('users_update') }}" : "{{ route('users_store') }}";
        var method = (userId) ? 'PUT' : 'POST';

        $.ajax({
            type: method,
            url: url,
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // contentType: false,
            // processData: false,
            success: function(response) {
                if (response.status === 'success') {
                    $('#user-form')[0].reset();
                    $('#user-id').val('');
                    $('.buttonform button').text("{{__('global.save')}}");

                    // $('#userstoreModal').modal('hide');
                    window.location.reload();
                }
            },
            error: function(error) {
                console.error('Error submitting form:', error);

                // Clear previous error messages
                $('#user-form .error').remove();

                if (error.responseJSON && error.responseJSON.errors) {
                    try {
                        var errors = error.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            // Display errors for input fields
                            $('#user-form input[name="' + key + '"]').after('<span class="error" style="color: red;">' + value[0] + '</span>');

                            // Display errors for checkboxes
                            $('#user-form input[type="checkbox"][name="' + key + '"]').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                        });
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                    }
                } else {
                    console.error('Empty or undefined responseText.');
                    console.log('Status:', error.status);
                    console.log('Response Text:', error.responseText);
                }
            }
        });
    }

    function editForm(user_id) {
        $.ajax({
            type: 'GET',
            url: "{{ route('users_edit') }}",
            data: {
                user_id: user_id,
            },
            success: function(response) {
                // console.log(response);
                if (response.status === 'success') {
                    var userData = response.data;
                    var role_id = response.role_id;
                    // console.log(role_id);

                    // Populate the form fields with the retrieved data
                    $('#user-id').val(userData.id);
                    $('#user-form input[name="first_name"]').val(userData.first_name);
                    $('#user-form input[name="last_name"]').val(userData.last_name);
                    $('#user-form input[name="username"]').val(userData.username);
                    $('#user-form input[name="email"]').val(userData.email);
                    $('#user-form input[name="password"]').val(userData.password);
                    $('#user-form input[name="birthdate"]').val(userData.birthdate);
                    $('#user-form select[name="role"]').val(role_id);

                    // Change the button text create to "Update"
                    $('.buttonform button').text("{{__('global.update')}}");
                }
            },
            error: function(error) {
                console.error('Error fetching user data:', error);
            }
        });
    }

    function deleteRecord(id) {
        Swal.fire({
            title: "{{ __('cruds.are_you_sure') }}",
            text: "{{ __('cruds.delete_this_record') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "{{ __('global.cancel') }}",
            confirmButtonText: "{{ __('cruds.yes_delete') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('users_delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            location.reload();
                        }
                    },
                });
            }
        });
    }
</script>
@endpush