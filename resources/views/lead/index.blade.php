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
            {!! $dataTable->table(['class' => 'table mb-0']) !!}
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
    var yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    $(document).on('show.bs.modal','#addLead', function () {
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

    $(document).on('hide.bs.modal','#addLead', function () {
        $('#birthdate').data('daterangepicker').remove();
    });

    // $(document).on('click','#add_lead',function(e){
    //     e.preventDefault();



    //     checkCampaignRecords(handleCampaignResult);
    //     $('#username').attr('disabled', false);
    //     $('#email').attr('disabled', false);
    //     $('#password, #send_password_on_email').parent().parent().show();
    //     $('#lead-id .error').remove();
    //     $('.buttonform button').text("{{__('global.save')}}");
    //     $('#userstoreModalLabel').text("{{__('cruds.new_user')}}");
    // });

    $(document).on('click','.addNewLeadBtn', function(e)
    {
       e.preventDefault();
        var hrefUrl = $(this).attr('data-href');
        console.log(hrefUrl);
        $.ajax({
            type: 'get',
            url: hrefUrl,
            dataType: 'json',
            success: function (response) {

                if(response.success) {
                    $('.popup_render_div').html(response.htmlView);
                    $('.popup_render_div #addLeadModal').modal('show');
                }
            }
        });
    });

</script>
@endpush
