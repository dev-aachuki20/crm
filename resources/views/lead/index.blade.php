@extends('layouts.master')
@section('title', __('cruds.lead.title'))
@push('styles')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.0/css/buttons.dataTables.min.css">
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
                        <button type="button" class="btn btn-blue btnsmall addNewLeadBtn" data-href="{{route('createLead')}}">+ {{__('cruds.add')}} {{__('cruds.lead.title_singular')}}</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <div class="d-flex justify-content-between">
            <h4>{{__('cruds.lead.fields.list_of_lead')}}</h4>
            <button class="btn btn-small" title="Export Excel" id="export-excel"><x-svg-icon icon="export-excel"/></button>
        </div>

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
{!! $dataTable->scripts() !!}

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- DataTables Buttons JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.print.min.js"></script>

<script>
$(document).ready(function(){

    var DataaTable = $('#dataaTable').DataTable();


    $('#export-excel').on('click', function(e) {
        e.preventDefault();
        // Get the search value
        var searchValue = DataaTable.search();

        // Get the sorting information
        var sorting = DataaTable.order();
        var sortColumnName = DataaTable.column(sorting[0][0]).dataSrc();
        var sortDirection = sorting[0][1];
        // $('#loader').css('display', 'block');
        var length = DataaTable.page.len();

        $.ajax({
            xhrFields: {
                responseType: 'blob',
            },
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url:  "{{ route('exportLeadExcel') }}",
            data: {
                length: length,
                search: searchValue,
                sortColumn: sortColumnName,
                sortDirection: sortDirection
            },
            success: function(result, status, xhr) {
                $('#loader').css('display', 'none');
                var disposition = xhr.getResponseHeader('content-disposition');
                var matches = /"([^"]*)"/.exec(disposition);
                var filename = (matches != null && matches[1] ? matches[1] : 'leads-list.xlsx');
                // The actual download
                var blob = new Blob([result], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
               console.log('Export successful');
            }
        });

    });

    function initializeDatepicker() {
        var yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);

        $('#birthdate').daterangepicker({
            autoApply: true,
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true,
            maxDate: yesterday,
            locale: {
                format: 'YYYY-MM-DD'
            },
        }, function(start, end, label) {
            $('#birthdate').val(start.format('YYYY-MM-DD'));
        });
    }

    /* Open Add Lead Form Modal */
    $(document).on('click','.addNewLeadBtn', function(e){
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

    $(document).on('click','#editLeadModal #EditForm #CancelFormBtn',function(e) {
        $('#editLeadModal').modal('hide');
    });

    // Get Area according Campaign
    $(document).on('change','#campaign_id', function(e) {
        e.preventDefault();
        var campaignId = $(this).val();
        if (campaignId) {
            var hrefUrl = "{{ route('campaignAreaList')}}";
            $.ajax({
                type: 'GET',
                url: hrefUrl,
                data: {
                    campaignId: campaignId
                },
                success: function(response) {
                    var selectedOption = $('#area_id').val();
                    $('#area_id').children('option:not(:first-child)').remove();
                    if (response.status && response.data) {
                        $.each(response.data, function(key, value) {
                            $('#area_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        // console.error('Error: Empty response or invalid data');
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
    $(document).on('submit', '#AddForm', function(e) {
        e.preventDefault();
        $('#loader').css('display', 'block');
        $("#AddForm button[type=submit]").prop('disabled',true);
        $(".error").remove();
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
                if(response.status == 1){
                    $('#addLeadModal').modal('hide');
                    toasterAlert('success', response.message);
                    $('#AddForm')[0].reset();
                    DataaTable.ajax.reload();
                    $("#AddForm button[type=submit]").prop('disabled',false);
                }else{
                    toasterAlert('error', @json(__('messages.error_message')));
                }
                $('#loader').css('display', 'none');
            },
            error: function (xhr) {
                var errors= xhr.responseJSON.errors;
                $('#loader').css('display', 'none');
                for (const elementId in errors) {
                    var errorHtml = '<div><span class="error text-danger">'+errors[elementId][0]+'</span></';
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
        var lead_id = $(this).attr('lead_id');
        $.ajax({
            type: 'get',
            url: hrefUrl,
            dataType: 'json',
            data: {
                lead_id: lead_id
            },
            success: function (response) {
                if(response.success) {
                    $('.popup_render_div').html(response.htmlView);
                    $('.popup_render_div #editLeadModal').modal('show');
                    initializeDatepicker();
                }
            }
        });
    });

    // Start Edit
    $(document).on('submit', '#editLeadModal #EditForm', function (e) {
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
                    // console.log('response' , response);
                    $('#editLeadModal').modal('hide');
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
                // console.log(xhr);
                var errors= xhr.responseJSON.errors;
                // console.log(xhr.responseJSON);
                for (const elementId in errors) {
                    //$("#EditForm #"+elementId).addClass('is-invalid');
                    var errorHtml = '<div><span class="error text-danger">'+errors[elementId][0]+'</span></';
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
                        // console.log(xhr.responseJSON);
                        toasterAlert('error',response.message);
                        $('#loader').css('display', 'none');
                    }
                });
            }
        });
    });


    $(document).on('change','#identification_type',function() {
        var $this = $(this);

        var maxLength = $this.find('option:selected').attr('data-max-rule');

        $('#identification').val('');
        $('#identification').siblings('div').children('span.error').remove();
        $('#identification').attr('maxlength', maxLength);
        $('#identificationField').removeClass('d-none');
    });

});

</script>
@endpush
