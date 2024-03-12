@extends('layouts.master')
@section('title', __('cruds.lead.title'))
@push('scripts')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endpush

@section('content')
<div class="container">
    <div class="headingbar">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="headingleft">
                    <h2>{{__('cruds.lead.title')}}</h2>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="buttongroup-block d-flex justify-content-end">
                    @can('leads_create')
                    <button type="button" class="btn btn-blue btnsmall addNewLeadBtn" data-href="{{route('leads.create',['lang' => app()->getLocale()])}}">+ {{__('cruds.add')}} {{__('cruds.lead.title_singular')}}</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <h4>{{__('cruds.lead.fields.list_of_lead')}}</h4>
        <div class="listing-table">
            {!! $dataTable->table(['class' => 'table mb-0','id'=>'dataaTable']) !!}
        </div>
    </div>
    <div class="popup_render_div"></div>
</div>

<!-- Loader element -->
<div id="loader">
    <div class="spinner"></div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
{!! $dataTable->scripts() !!}

<script>
$(document).ready(function(){

    var DataaTable = $('#dataaTable').DataTable();


    function initializeDatepicker() {
        var yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);

        $('#birthdate').daterangepicker({
            autoApply: true,
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true, // Set autoUpdateInput to true
            maxDate: yesterday,
            locale: {
                format: 'YYYY-MM-DD'
            },
        }, function(start, end, label) {
            $('#birthdate').val(start.format('YYYY-MM-DD')); // Update the input field with the selected date
        });
    }
    // Open Add Lead Form Modal

    $(document).on('click','.addNewLeadBtn', function(e)
    {
       e.preventDefault();
        var hrefUrl = $(this).attr('data-href');
        $.ajax({
            type: 'get',
            url: hrefUrl,
            dataType: 'json',
            success: function (response) {

                if(response.success) {
                    $('.popup_render_div').html(response.htmlView);
                    $('.popup_render_div #addLeadModal').modal('show');
                    initializeDatepicker();
                }
            }
        });
    });

    // Close modal on cancel
    $(document).on('click','#addLeadModal #AddForm #CancelFormBtn',function(e) {
        e.preventDefault();
        $('#AddForm')[0].reset();
        $('#addLeadModal').modal('hide');
    });

    // Get Area according Campaign
    $(document).on('change','#campaign_id', function(e) {
        e.preventDefault();
        var campaignId = $(this).val();
        console.log(campaignId);

        if (campaignId) {
            var hrefUrl = "{{ route('campaign.areaList', ['lang' => app()->getLocale(), 'campaignId' => ':campaignId']) }}";
            hrefUrl = hrefUrl.replace(':campaignId', campaignId);
            $.ajax({
                type: 'GET',
                url: hrefUrl,
                success: function(response) {
                    // Store the selected option if it exists
                    var selectedOption = $('#area_id').val();
                    // Clear existing options except the "Select the Area" option
                    $('#area_id').children('option:not(:first-child)').remove();
                    if (response.status && response.data) {
                        $.each(response.data, function(key, value) {
                            // Append each area as an option to the select box
                            $('#area_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        console.error('Error: Empty response or invalid data');
                    }

                    if (selectedOption) {
                        $('#area_id').val(selectedOption);
                    }
                }
            });
        } else {
            $('#area_id').empty();
        }
    });

    // Add Lead
    $(document).on('submit','#addLeadModal #AddForm', function (e)
    {
        e.preventDefault();
        $('#loader').css('display', 'block');
        $("#AddForm button[type=submit]").prop('disabled',true);
        $(".error").remove();
        $(".is-invalid").removeClass('is-invalid');
        var formData = $(this).serialize();
        var formAction = $(this).attr('action');
        $.ajax({
            url: formAction,
            type: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                    $('#addLeadModal').modal('hide');
                    $('#loader').css('display', 'none');
                    toasterAlert('success', response.message);
                    $('#AddForm')[0].reset();
                    DataaTable.ajax.reload();
                    $("#AddForm button[type=submit]").prop('disabled',false);
            },
            error: function (xhr) {
                var errors= xhr.responseJSON.errors;
                console.log(errors);
                $('#loader').css('display', 'none');
                for (const elementId in errors) {
                    $("#"+elementId).addClass('is-invalid');
                    var errorHtml = '<div><span class="error text-danger">'+errors[elementId]+'</span></';
                    $(errorHtml).insertAfter($("#addLeadModal #"+elementId));
                }
                $("#AddForm button[type=submit]").prop('disabled',false);
            }
        });
    });

    // Open Edit Lead Form Modal

    $(document).on('click','.edit-lead-btn', function(e)
    {
       e.preventDefault();
        var hrefUrl = $(this).attr('data-href');
        $.ajax({
            type: 'get',
            url: hrefUrl,
            dataType: 'json',
            success: function (response) {
                if(response.success) {
                    $('.popup_render_div').html(response.htmlView);
                    $('.popup_render_div #editLeadModal').modal('show');
                    initializeDatepicker();
                }
            }
        });
    });

    // edit item
    $(document).on('submit', '#editLeadModal #EditForm', function (e) {
        e.preventDefault();
        $("#EditForm button[type=submit]").prop('disabled',true);
        $('#loader').css('display', 'block');
        $(".error").remove();
        $(".is-invalid").removeClass('is-invalid');
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
                    $('#editLeadModal').modal('hide');
                    $('#loader').css('display', 'none');
                    toasterAlert('success', response.message);
                    $('#EditForm')[0].reset();
                    DataaTable.ajax.reload();
                    $("#EditForm button[type=submit]").prop('disabled',false);
            },
            error: function (xhr) {
                var errors= xhr.responseJSON.errors;
                console.log(xhr.responseJSON);
                for (const elementId in errors) {
                    $("#EditForm #"+elementId).addClass('is-invalid');
                    var errorHtml = '<div><span class="error text-danger">'+errors[elementId]+'</span></';
                    $(errorHtml).insertAfter($("#EditForm #"+elementId));
                }
                $("#EditForm button[type=submit]").prop('disabled',false);
            }
        });
    });

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
                $.ajax({
                    url: formAction,
                    type: 'DELETE',
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
                    },
                    error: function (xhr) {
                        var errors= xhr.responseJSON.errors;
                        console.log(xhr.responseJSON);
                        toasterAlert('error',response.message);
                    }
                });
            }
        });
    });






});




</script>
@endpush
