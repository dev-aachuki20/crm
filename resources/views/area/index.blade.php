@extends('layouts.master')
@section('title', __('cruds.area.title'))
@section('content')
<div class="container">
    <div class="headingbar">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="headingleft">
                    <h2>{{__('cruds.area.title')}}</h2>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="buttongroup-block d-flex justify-content-end">
                    @can('area_create')
                        <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#areastoreModal" id="area">
                            + {{__('cruds.add')}} {{__('cruds.area.title_singular')}}
                        </button>
                    @endcan    
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3 ">
        <h4>{{__('cruds.list_created_area')}}</h4>
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
<div class="modal fade new-channel-popup" id="areastoreModal" tabindex="-1" aria-labelledby="areastoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="areastoreModalLabel">{{__('cruds.enter_new_area')}}</h5>
                <button type="button" class="btn-close" id="cancelButton" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="area-form">
                    @csrf
                    <input type="hidden" id="area-id" name="area_id" value="">

                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>{{__('cruds.area.fields.name')}}:</label>
                                <input type="text" name="area_name" class="form-control" />
                                @if($errors->has('area_name'))
                                <span style="color: red;">{{ $errors->first('area_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>{{__('cruds.area.fields.description')}}:</label>
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
    $(document).on('submit','#area-form',function(e){
        e.preventDefault();

        $('#loader').css('display', 'block');

        var formData = $('#area-form').serialize();
        var areaId = $('#area-id').val();

        var url = (areaId) ? "{{ route('areas_update') }}" : "{{ route('areas_store') }}";
        var method = (areaId) ? 'PUT' : 'POST';

        $.ajax({
            type: method,
            url: url,
            data: formData,
            success: function(response) {
                $('#loader').css('display', 'none');
               
                if (response.status === 'success') {
                    $('#area-form')[0].reset();
                    $('#area-id').val('');
                    $('.buttonform button').text("{{ __('global.create') }}");

                    $('#areastoreModal').modal('hide');
                    
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
                $('#area-form .error').remove();
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#area-form').find('input[name=' + key + ']').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                        $('#area-form').find('textarea[name=' + key + ']').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                    });
                } else {
                    console.error('Unexpected error:', errorThrown);
                }
            }
        });
    });
   

    function editForm(area_id) {
        // Clear previous error messages
        $('#area-form .error').remove();
        $.ajax({
            type: 'GET',
            url: "{{ route('areas_edit') }}",
            data: {
                area_id: area_id,
            },
            success: function(response) {
                if (response.status === 'success') {
                    var areaData = response.data;

                    // Populate the form fields with the retrieved data
                    $('#area-id').val(areaData.id);
                    $('#area-form input[name="area_name"]').val(areaData.area_name);
                    $('#area-form textarea[name="description"]').val(areaData.description);

                    // Change the button text create to "Update"
                    $('.buttonform button').text("{{ __('global.update') }}");
                    $('#areastoreModalLabel').text("{{__('global.update')}} {{__('cruds.area.title_singular')}}")
                }
            },
            error: function(error) {
                console.error('Error fetching area data:', error);
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
                    url: "{{ route('areas_delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toasterAlert('success',response.message);
                            refreshDataTable();
                        } else if(response.status === 'error'){
                            toasterAlert('warning',response.message);
                        }
                    },
                });
            }
        });
    }

    $('#cancelButton').click(function() {
        $('#area-form')[0].reset();
    });
    $('#area').click(function() {
        $('#area-form .error').remove();
    });

    function refreshDataTable() {
        $('#area-table').DataTable().draw();
    }
</script>
@endpush