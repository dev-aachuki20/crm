@extends('layouts.master')
@section('title', __('cruds.user.title'))

@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endpush

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
                    @can('user_create')
                        <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#userstoreModal" id="user">
                            + {{__('global.add')}} {{__('cruds.new')}} {{__('cruds.user.title_singular')}}
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <h4>{{__('cruds.user.title')}} {{__('global.list')}}</h4>
        <div class="listing-table">
            {!! $dataTable->table(['class' => 'table mb-0']) !!}
        </div>
    </div>
</div>

<!-- Loader element -->
<div id="loader">
    <div class="spinner"></div>
</div>

<!-- Modal -->
<div class="modal fade new-channel-popup" id="userstoreModal" tabindex="-1" aria-labelledby="userstoreModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="userstoreModalLabel">{{__('cruds.new_user')}}</h5>
                <button type="button" class="btn-close" id="userButton" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="user-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="user-id" name="user_id" value="">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.first_name')}}:</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.last_name')}}:</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.user_name')}}:</label>
                                        <input type="text" class="form-control" name="username" id="username" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.role')}}:</label>
                                        <select class="form-control" name="role" id="role">
                                            <option value="">Select {{__('cruds.user.fields.role')}}</option>
                                            @foreach($roleData as $role)
                                            <option value="{{ $role->id }}">{{ $role->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.email')}}:</label>
                                        <input type="email" class="form-control" name="email" id="email" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.password')}}:</label>
                                        <input type="password" class="form-control" name="password" id="password" autocomplete="off"/>
                                        <span toggle="#password-field" class="form-icon-password toggle-password" style="top: 45px;"><img src="{{asset('images/view.svg')}}" class="img-fluid" /></span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.user.fields.birthdate')}}:</label>
                                        <input type="text" class="form-control" name="birthdate" id="birthdate" readonly placeholder="DOB"/>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('cruds.upload')}}:</label>
                                        <input type="file" name="image" class="form-control" id="image" onchange="readURL(this);" />
                                        <div class="image-preview" style="">
                                            <img id="previewImage" src="{{asset('images/man.png')}}" alt="Image Preview">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group checboxcont">
                                        <input type="checkbox" name="send_password_on_email" id="send_password_on_email" class="form-control"> {{__('cruds.send_password_to_mail')}}
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
                                        <input type="checkbox" name="campaign[]" class="form-control" id="campaign-{{$campaign->id}}" value="{{$campaign->id}}">
                                        <span>{{ucwords($campaign->campaign_name)}}</span>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="campaign-error"></div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-12">
                            <div class="buttonform">
                                <button type="submit" class="btn btn-green btnsmall" id="savebtnsubmit">{{__('global.save')}}</button>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
{!! $dataTable->scripts() !!}
<script>
    var yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    $(document).on('show.bs.modal','#userstoreModal', function () {        
        $('#birthdate').daterangepicker({
            autoApply: true,
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            maxDate: yesterday,
            locale: {
                format: 'YYYY-MM-DD'
            },
        },
        function(start, end, label) {
            $('#birthdate').val(start.format('YYYY-MM-DD'));
        });
    });

    $(document).on('hide.bs.modal','#userstoreModal', function () {
        $('#birthdate').data('daterangepicker').remove();
    });
    
    $(document).on('click','#user',function(e){
        e.preventDefault();

        $('#previewImage').attr('src', "{{asset('images/man.png')}}");
        $('#username').attr('disabled', false);
        $('#email').attr('disabled', false);
        $('#password, #send_password_on_email').parent().parent().show();
    });
    

    $(document).on('submit','#user-form',function(e){
        e.preventDefault();

        $('#loader').css('display', 'block');

        // var formData = $('#user-form').serialize();
        var userId = $('#user-id').val();

        var formDataWithFile = new FormData(this);
        var url = (userId) ? "{{ route('users_update') }}" : "{{ route('users_store') }}";

        /* var selectedCampaigns = $('input[name="campaign_id[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        formData += '&campaign_id=' + selectedCampaigns.join(','); */

        // formDataWithFile.append('campaign_id', selectedCampaigns.join(','));

        // var sendPasswordToEmail = $('#send_password_on_email').prop('checked') ? 1 : 0;
        // formDataWithFile.append('send_password_on_email', sendPasswordToEmail);
        $.ajax({
            type: 'POST',
            url: url,
            data: formDataWithFile,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#loader').css('display', 'none');

                if (response.status === 'success') {
                    $('#user-form')[0].reset();
                    $('#user-id').val('');
                    $('#username').attr('disabled', false);
                    $('#email').attr('disabled', false);
                    $('.buttonform button').text("{{__('global.save')}}");

                    $('#userstoreModal').modal('hide');

                    toasterAlert('success',response.message);

                    refreshDataTable();
                }
            },
            error: function(error) {
                // console.error('Error submitting form:', error);
                setTimeout(function() {
                    $('#loader').css('display', 'none');
                }, 500);
                $('#user-form .error').remove();
                if (error.responseJSON && error.responseJSON.errors) {
                    try {
                        var errors = error.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#user-form input[name="' + key + '"]').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                            if(key == 'campaign'){
                                $('#campaign-error').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                            }
                            $('#user-form select[name="' + key + '"]').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                        });
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                    }
                } else {
                    console.error('Empty or undefined responseText.');
                    // console.log('Status:', error.status);
                    // console.log('Response Text:', error.responseText);
                }
            }
        });

    });

    function editForm(user_id) {
        
        $('#loader').css('display', 'block');
        $('#user-form .error').remove();
        $('#previewImage').attr('src', "{{asset('images/man.png')}}");
        $('#password, #send_password_on_email').parent().parent().hide();

        $.ajax({
            type: 'GET',
            url: "{{ route('users_edit') }}",
            data: {
                user_id: user_id,
            },
            success: function(response) {
                
                $('#loader').css('display', 'none');
                
                if (response.status === 'success') {
                    
                   $(document).find('#userstoreModal').modal('show');

                    $('#user-id').val(response.data.id);
                    $('#first_name').val(response.data.first_name);
                    $('#last_name').val(response.data.last_name);
                    $('#username').val(response.data.username);
                    $('#email').val(response.data.email);
                    $('#birthdate').val(response.data.birthdate);

                    // $('#birthdate').data('daterangepicker').remove();
                    $('#birthdate').daterangepicker({
                        autoApply: true,
                        singleDatePicker: true,
                        showDropdowns: true,
                        autoUpdateInput: false,
                        startDate: response.data.birthdate,
                        maxDate: yesterday,
                        locale: {
                            format: 'YYYY-MM-DD'
                        },
                    },
                    function(start, end, label) {
                        $('#birthdate').val(start.format('YYYY-MM-DD'));
                    });


                    $('#role').val(response.role_id);
                    if ((response.data.username) || (response.data.email)) {
                        $('#username').attr('disabled', true);
                        $('#email').attr('disabled', true);
                    }
                    if (response.profile) {
                        $('#previewImage').attr('src', response.profile);
                    }

                    console.log(response.campaigns);
                    /* For get the campaign Id */
                    if (response.campaigns) {
                        try {
                            response.campaigns.forEach(function(campaignId) {
                                /* console.log('campaignId', parseInt(campaignId)) */
                                $('#campaign-' + parseInt(campaignId)).prop('checked', true);
                            });
                        } catch (error) {
                            // console.log('Error parsing campaignId:', error);
                        }
                    }

                    $('#send_password_on_email').prop('checked', response.data.send_password_on_email);

                    $('.buttonform button').text("{{__('global.update')}}");
                    $('#userstoreModalLabel').text("{{__('global.update')}} {{__('cruds.user.title_singular')}}")
                }
            },
            error: function(error) {
                $('#loader').css('display', 'none');
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
                            refreshDataTable();
                            toasterAlert('success',response.message);
                        }
                    },
                });
            }
        });
    }


    $('#userButton').click(function() {
        $('#user-form')[0].reset();
    });

    $('#user').click(function() {
        $('#user-form .error').remove();
        $('.buttonform button').text("{{__('global.save')}}");
        $('#userstoreModalLabel').text("{{__('cruds.new_user')}}");
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#previewImage')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('click', '.toggle-password', function() {
        $(this).toggleClass("eye-open");

        var input = $("#password");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });


    function refreshDataTable() {
        $('#user-table').DataTable().draw();
    }
</script>
@endpush