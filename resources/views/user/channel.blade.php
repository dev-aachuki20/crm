@extends('layouts.master')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
@endpush
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
                    <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#channelstoreModal">+ {{__('cruds.add')}} {{__('cruds.channel.title_singular')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <h4>{{__('cruds.list_created_channel')}}</h4>
        {!! $dataTable->table(['class' => 'table mb-0']) !!}
    </div>
</div>
<!-- Modal for store -->
<div class="modal fade new-channel-popup" id="channelstoreModal" tabindex="-1" aria-labelledby="channelstoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="channelstoreModalLabel">Enter the new channel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="channel-form">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>Channel name:</label>
                                <input type="text" name="channel_name" class="form-control" />
                                @if($errors->has('channel_name'))
                                <span style="color: red;">{{ $errors->first('channel_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" name="description"></textarea>
                                @if($errors->has('description'))
                                <span style="color: red;">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="buttonform text-end">
                                <button type="button" class="btn btn-blue btnsmall" onclick="submitForm()">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for update record -->
<div class="modal fade new-channel-popup" id="channelupdateModal" tabindex="-1" aria-labelledby="channelupdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="channelupdateModalLabel">Update Channel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="channel-edit-form">
                    @csrf
                    <input type="hidden" id="channel-id" name="channel_id" value="">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>Channel name:</label>
                                <input type="text" name="channel_name" id="channel-name" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" name="description" id="channel-description"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="buttonform text-end">
                                <button type="button" class="btn btn-blue btnsmall" onclick="updateForm()">Update</button>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
{!! $dataTable->scripts() !!}

<script>
    function submitForm() {
        var formData = $('#channel-form').serialize();
        $.ajax({
            type: 'POST',
            url: "{{route('channels_store')}}",
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    $('#channel-form')[0].reset();
                    $('#channelstoreModal').modal('hide');
                    location.reload();
                }
            },
            error: function(error) {
                console.error('Error submitting form:', error);
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function(key, value) {
                    $('#channel-form').find('input[name=' + key + ']').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                    $('#channel-form').find('textarea[name=' + key + ']').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                });
            }
        });
    }

    function editForm(url) {
        console.log(url);
        $('#channel-id').val(url);

        // $.ajax({
        //     type: 'GET',
        //     url: url,
        //     success: function(response) {
        //         if (response.status === 'success') {
        //             var channelData = response.data;

        //             // Populate the form fields with the retrieved data
        //             $('#channel-name').val(channelData.channel_name);
        //             $('#channel-description').val(channelData.description);

        //             // Show the modal
        //             $('#channelupdateModal').modal('show');
        //         }
        //     },
        //     error: function(error) {
        //         console.error('Error fetching channel data:', error);
        //         // Handle errors if needed
        //     }
        // });
    }

    // function updateForm(channel_id) {
    //     alert('update');
    // }

    function deleteRecord(id) {
        $.ajax({
            type: 'DELETE',
            url: "{{ route('channels_delete', ':id') }}".replace(':id', id),
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#channel-form')[0].reset();
                    $('#channelstoreModal').modal('hide');
                    location.reload();
                }
            },
        });
    }
</script>

@endpush