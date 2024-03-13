@extends('layouts.master')
@section('title', __('cruds.interaction.title'))

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@section('content')
<!-- Loader element -->
<div id="loader">
    <div class="spinner"></div>
</div>

<div class="container">
    <div class="headingbar">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="headingleft">
                    <h2>@lang('cruds.interaction.title')</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <h4>@lang('cruds.interaction.title') @lang('global.list')</h4>

        <div class="listing-table">
            {!! $dataTable->table(['class' => 'table mb-0','id'=>'dataTable']) !!}
        </div>

    </div>

 <div class="popup_render_div"></div>

</div>

@endsection

@push('scripts')

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
{!! $dataTable->scripts() !!}

<script>
$(document).ready(function(){

    var DataaTable = $('#dataTable').DataTable();

    /*function initializeDatepicker() {
        
        $('#registration_at').daterangepicker({
            autoApply: true,
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true, // Set autoUpdateInput to true
            timePicker: true,
            timePicker24Hour: true,
            maxDate: moment().format('YYYY-MM-DD HH:mm'),
            startDate: moment().format('YYYY-MM-DD HH:mm'),
            locale: {
                format: 'YYYY-MM-DD HH:mm'
            },
        }, function(start, end, label) {
            $('#registration_at').val(start.format('YYYY-MM-DD HH:mm')); // Update the input field with the selected date
        });
    }*/

    // Open Edit Interaction Form Modal
    $(document).on('click','.edit-interaction-btn', function(e){
        e.preventDefault();
        var hrefUrl = $(this).attr('data-href');
        $.ajax({
            type: 'get',
            url: hrefUrl,
            dataType: 'json',
            success: function (response) {

                if(response.success) {
                    $('.popup_render_div').html(response.htmlView);
                    $('.popup_render_div #editInteractionModal').modal('show');
                    // initializeDatepicker();
                }
            }
        });
    });

    // Close modal on cancel
    $(document).on('click','#editInteractionModal #EditForm #CancelFormBtn',function(e) {
        e.preventDefault();
        $('#EditForm')[0].reset();
        $('#editInteractionModal').modal('hide');
    });

    // Start Edit
    $(document).on('submit', '#editInteractionModal #EditForm', function (e) {
        e.preventDefault();
        $("#EditForm button[type=submit]").prop('disabled',true);
        $('#loader').css('display', 'block');
        $(".error").remove();
        //$(".is-invalid").removeClass('is-invalid');
        var formData = $(this).serialize();
        var formAction = $(this).attr('action');

        $.ajax({
            url: formAction,
            type: 'PUT',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            data: formData,
            success: function (response) {
                if(response.status == 1){
                    console.log('response' , response);
                    $('#editInteractionModal').modal('hide');
                    toasterAlert('success', response.message);
                    $('#EditForm')[0].reset();
                    DataaTable.ajax.reload();
                    $("#EditForm button[type=submit]").prop('disabled',false);
                }else{
                    toasterAlert('error', @json(__('messages.error_message')));
                }
                $('#loader').css('display', 'none');
            },
            error: function (xhr) {
                console.log(xhr);
                var errors= xhr.responseJSON.errors;
                console.log(xhr.responseJSON);
                for (const elementId in errors) {
                    //$("#EditForm #"+elementId).addClass('is-invalid');
                    var errorHtml = '<div><span class="error text-danger">'+errors[elementId]+'</span></';
                    $(errorHtml).insertAfter($("#EditForm #"+elementId));
                }
                setTimeout(() => {
                    $('#loader').css('display', 'none');
                }, 100);
                $("#EditForm button[type=submit]").prop('disabled',false);
            }
        });
    });

    // Start Delete
    $(document).on('submit', '.deleteForm', function(e) {
        e.preventDefault();
        var formAction = $(this).attr('action');

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
                $('#loader').css('display', 'block');
                $.ajax({
                    url: formAction,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                            if (response.status) {
                                toasterAlert('success',response.message);
                                DataaTable.ajax.reload();
                            }else{
                                toasterAlert('warning',response.message);
                            }
                            $('#loader').css('display', 'none');
                    },
                    error: function (xhr) {
                        var errors= xhr.responseJSON.errors;
                        console.log(xhr.responseJSON);
                        toasterAlert('error',response.message);
                        $('#loader').css('display', 'none');
                    }
                });
            }
        });
    });
    
});

</script>

@endpush
