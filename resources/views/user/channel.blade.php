@extends('layouts.master')
@section('title', __('cruds.channel.title'))
@section('content')
<div class="container">
    <div class="headingbar">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="headingleft">
                    <h2>{{__('cruds.channel.title')}}</h2>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="buttongroup-block d-flex justify-content-end">
                    <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#channelstoreModal" id="channel">+ {{__('cruds.add')}} {{__('cruds.channel.title_singular')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3 ">
        <h4>{{__('cruds.list_created_channel')}}</h4>
        <div class="listing-table">
            {!! $dataTable->table(['class' => 'table mb-0']) !!}
        </div>
    </div>

</div>

<!-- Loader element -->
<div id="loader">
    <div class="spinner"></div>
</div>

<!-- Modal for store -->
<div class="modal fade new-channel-popup" id="channelstoreModal" tabindex="-1" aria-labelledby="channelstoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="channelstoreModalLabel">{{__('cruds.enter_new_channel')}}</h5>
                <button type="button" class="btn-close" id="cancelButton" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="channel-form">
                    @csrf
                    <input type="hidden" id="channel-id" name="channel_id" value="">

                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>{{__('cruds.channel.fields.name')}}:</label>
                                <input type="text" name="channel_name" class="form-control" />
                                @if($errors->has('channel_name'))
                                <span style="color: red;">{{ $errors->first('channel_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>{{__('cruds.channel.fields.description')}}:</label>
                                <textarea class="form-control" name="description"></textarea>
                                @if($errors->has('description'))
                                <span style="color: red;">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="buttonform text-end">
                                <button type="submit" class="btn btn-blue btnsmall" >{{__('global.create')}}</button>
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
    $(document).on('submit','#channel-form',function(e){
        e.preventDefault();

        $('#loader').css('display', 'block');

        var formData = $('#channel-form').serialize();
        var channelId = $('#channel-id').val();

        var url = (channelId) ? "{{ route('channels_update') }}" : "{{ route('channels_store') }}";
        var method = (channelId) ? 'PUT' : 'POST';

        $.ajax({
            type: method,
            url: url,
            data: formData,
            success: function(response) {
                $('#loader').css('display', 'none');
               
                if (response.status === 'success') {
                    $('#channel-form')[0].reset();
                    $('#channel-id').val('');
                    $('.buttonform button').text("{{ __('global.create') }}");

                    $('#channelstoreModal').modal('hide');
                    
                    // window.location.reload();
                    toasterAlert('success',response.message);
                    refreshDataTable();
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // console.error('Error submitting form:', textStatus);
                setTimeout(function() {
                    $('#loader').css('display', 'none');
                }, 500);
                $('#channel-form .error').remove();
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#channel-form').find('input[name=' + key + ']').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                        $('#channel-form').find('textarea[name=' + key + ']').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                    });
                } else {
                    console.error('Unexpected error:', errorThrown);
                }
            }
        });
    });
   

    function editForm(channel_id) {
        // Clear previous error messages
        $('#channel-form .error').remove();
        $.ajax({
            type: 'GET',
            url: "{{ route('channels_edit') }}",
            data: {
                channel_id: channel_id,
            },
            success: function(response) {
                if (response.status === 'success') {
                    var channelData = response.data;

                    // Populate the form fields with the retrieved data
                    $('#channel-id').val(channelData.id);
                    $('#channel-form input[name="channel_name"]').val(channelData.channel_name);
                    $('#channel-form textarea[name="description"]').val(channelData.description);

                    // Change the button text create to "Update"
                    $('.buttonform button').text("{{ __('global.update') }}");
                    $('#channelstoreModalLabel').text("{{__('global.update')}} {{__('cruds.channel.title_singular')}}")
                }
            },
            error: function(error) {
                console.error('Error fetching channel data:', error);
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
                    url: "{{ route('channels_delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toasterAlert('success',response.message);
                            refreshDataTable();
                        }
                    },
                });
            }
        });
    }

    $('#cancelButton').click(function() {
        $('#channel-form')[0].reset();
    });
    $('#channel').click(function() {
        $('#channel-form .error').remove();
    });

    function refreshDataTable() {
        $('#channel-table').DataTable().draw();
    }
</script>
@endpush