@extends('layouts.master')
@section('title', __('cruds.home.title'))

@push('styles')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endpush


@section('content')
<!-- Loader element -->
<div id="loader">
    <div class="spinner"></div>
</div>

<div class="container">

 <!-- MAIN BLOCK START -->
 <section class="mainwraaper-sec d-flex justify-content-end align-items-center py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="registered-data">
                    <div class="search-title-bar d-flex justify-content-between">
                        <h4 class="text-capitalize">@lang('cruds.home.registration_data')</h4>

                        <div class="d-flex justify-content-between">
                        @can('leads_edit')
                            <button title="{{trans('global.edit')}}" class="btn btn-sm edit-lead-btn" data-lead_id="{{$lead->id}}" data-href="{{route('editLead', ['lead' => $lead->id])}}"><x-svg-icon icon='edit'/></button>
                        @endcan
    
                        @can('leads_delete')
                            <form action="{{route('deleteLead', ['lead' => $lead->id])}}" method="POST" class="deleteForm">
                                @csrf
                                <button title="{{trans('global.delete')}}" class="btn btn-sm lead_delete_btn my-4"><x-svg-icon icon='delete'/></button>
                            </form>
                        @endcan
                        </div>
                    </div>
                    
                    
                    <div class="datablock lead-view">
                        @include('search.partials.lead-view')
                    </div>
                </div>

                {{-- Start Interaction Records --}}
                <div class="observation-data">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <div class="datablock-observation">
                                @if($lead->interactions()->count() > 0)

                                @php
                                   $latestInteractions =  $lead->interactions()->orderBy('created_at','desc')->first();
                                @endphp

                                <div class="latest-interaction">
                                    <h6>
                                        {{ $lead->identification }} / {{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('d-m-Y') }} / {{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('H') }}h{{ \Carbon\Carbon::parse($latestInteractions->registration_at)->format('i') }}
                                    </h6>
                                    <p>
                                        {{ nl2br($latestInteractions->customer_observation) }}
                                    </p>
                                    <ul class="mb-0 list-unstyled">
                                        <li>@lang('cruds.interaction.title'): <span>{{ $lead->interactions()->count() }}</span></li>
                                        <li>@lang('cruds.interaction.fields.campaign'): <span>{{ isset($lead->campaign) ? $lead->campaign->campaign_name :'' }}</span></li>
                                        <li>@lang('cruds.interaction.fields.area'): <span>{{ isset($lead->area) ? $lead->area->area_name : '' }}</span></li>
                                        <li>@lang('cruds.interaction.fields.created_by'): <span>{{ $lead->createdBy->name }}</span></li>
                                    </ul>
                                </div>

                               
                                @endif
                               
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="buttongroup-block d-flex justify-content-end">
                               
                                @can('interaction_create')
                                <button type="button" class="btn btn-blue btnsmall addNewInterationBtn" data-href="{{ route('interactions-create', ['uuid' => $lead->uuid]) }}">+ {{__('global.add')}} {{__('cruds.interaction.title_singular')}}</button>
                                @endcan

                            </div>
                        </div>
                        
                        @if($lead->interactions()->count() > 0)
                        <div class="col-12">

                            <div class="datablock-observationinner interaction-list">
                                    
                            </div>
                            <div class="data-loader-area text-center">
                                <img src="{{ asset('images/data-loader.gif') }}" alt="Loader" class="img-fluid">
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
                {{-- End Interaction Records --}}

            </div>
            <div class="col-12 col-lg-4">
                <div class="daily-task">
                    <h4 class="text-capitalize text-center mb-4">Daily Task</h4>
                    <div class="taskbox-group">
                        <div class="daily-taskbox">
                            <div class="sidebyside">
                                <div class="left">
                                    <h6>Day Task</h6>
                                    <p>Cliente # llamar 4pm si no contesta llamar nuevamente </p>
                                </div>
                                <div class="right">
                                    Junio
                                    <img src="{{ asset('images/box.svg') }}" class="img-fluid">
                                    <span>16, 2023 09h00</span>
                                </div>
                            </div>
                            <div class="task-buttongroup">
                                <button type="button" class="btn btnsmall btn-green">Complete</button>
                                <button type="button" class="btn btnsmall btn-orange">Reschedule</button>
                                <button type="button" class="btn btnsmall btn-blue">Reasign</button>
                                <button type="button" class="btn btnsmall btn-red">Delete</button>
                            </div>
                        </div>
                        <!--  -->
                        <div class="daily-taskbox">
                            <div class="sidebyside">
                                <div class="left">
                                    <h6>Day Task</h6>
                                    <p>Cliente # llamar 4pm si no contesta llamar nuevamente </p>
                                </div>
                                <div class="right">
                                    Junio
                                    <img src="{{ asset('images/box.svg') }}" class="img-fluid">
                                    <span>16, 2023 09h00</span>
                                </div>
                            </div>
                            <div class="task-buttongroup">
                                <button type="button" class="btn btnsmall btn-green">Complete</button>
                                <button type="button" class="btn btnsmall btn-orange">Reschedule</button>
                                <button type="button" class="btn btnsmall btn-blue">Reasign</button>
                                <button type="button" class="btn btnsmall btn-red">Delete</button>
                            </div>
                        </div>
                        <!--  -->
                        <div class="daily-taskbox">
                            <div class="sidebyside">
                                <div class="left">
                                    <h6>Day Task</h6>
                                    <p>Cliente # llamar 4pm si no contesta llamar nuevamente </p>
                                </div>
                                <div class="right">
                                    Junio
                                    <img src="{{ asset('images/box.svg') }}" class="img-fluid">
                                    <span>16, 2023 09h00</span>
                                </div>
                            </div>
                            <div class="task-buttongroup">
                                <button type="button" class="btn btnsmall btn-green">Complete</button>
                                <button type="button" class="btn btnsmall btn-orange">Reschedule</button>
                                <button type="button" class="btn btnsmall btn-blue">Reasign</button>
                                <button type="button" class="btn btnsmall btn-red">Delete</button>
                            </div>
                        </div>
                        <!--  -->
                        <div class="daily-taskbox">
                            <div class="sidebyside">
                                <div class="left">
                                    <h6>Day Task</h6>
                                    <p>Cliente # llamar 4pm si no contesta llamar nuevamente </p>
                                </div>
                                <div class="right">
                                    Junio
                                    <img src="{{ asset('images/box.svg') }}" class="img-fluid">
                                    <span>16, 2023 09h00</span>
                                </div>
                            </div>
                            <div class="task-buttongroup">
                                <button type="button" class="btn btnsmall btn-green">Complete</button>
                                <button type="button" class="btn btnsmall btn-orange">Reschedule</button>
                                <button type="button" class="btn btnsmall btn-blue">Reasign</button>
                                <button type="button" class="btn btnsmall btn-red">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="buttongroup-block mt-4 text-center">
                        <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#todaytask">+ Add Task</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>
 <!-- MAIN BLOCK END -->

 <div class="popup_render_div"></div>

</div>


@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $(document).ready(function(){

        var latestInteractionId = "{{  ($lead->interactions()->count() > 0) ? $lead->interactions()->orderBy('created_at','desc')->value('uuid') : ''}}";
        var nextPageUrl = "{{ route('loadInteractionList',['uuid'=>$uuid]) }}";
      
        loadMoreInteractionList();

        $('.interaction-list').scroll(function() {
            var element = $(this)[0];
            if (element.scrollHeight - element.scrollTop === element.clientHeight) {
                loadMoreInteractionList();
            }
        });

        function getLatestInteraction() {
            var hrefUrl = "{{ route('latestInteraction',['uuid'=>$uuid]) }}";
            $.ajax({
                type: 'get',
                url: hrefUrl,
                dataType: 'json',
                success: function (response) {
                    if(response.success) {
                        latestInteractionId = response.latestInteractionId;
                        $('.latest-interaction').html(response.htmlView);
                        loadMoreInteractionList();
                    }
                }
            });
        }

        function loadMoreInteractionList(){

           if(nextPageUrl){
                $('.data-loader-area').css('display', 'block');

                $.ajax({
                    url: nextPageUrl,
                    type: 'get',
                    data: { latestInteractionId:latestInteractionId},
                    dataType: 'json',
                    beforeSend: function(){
                        nextPageUrl='';
                    },
                    success: function(res){
                        nextPageUrl = res.nextPageUrl;
                        $('.interaction-list').append(res.htmlView);
                    },
                    error: function(res, status, error){
                        console.log(error);
                    },
                    complete: function(res){
                        $('.data-loader-area').css('display', 'none');
                    }
                });
           }
            
        }

        function initializeDatepicker() {
           
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
        }

        // Open Add Interaction Form Modal

        $(document).on('click','.addNewInterationBtn', function(e){
           e.preventDefault();
            var hrefUrl = $(this).attr('data-href');
            $.ajax({
                type: 'get',
                url: hrefUrl,
                dataType: 'json',
                success: function (response) {
    
                    if(response.success) {
                        $('.popup_render_div').html(response.htmlView);
                        $('.popup_render_div #addInteractionModal').modal('show');
                        initializeDatepicker();
                    }
                }
            });
        });
    
        // Close modal on cancel
        $(document).on('click','#addInteractionModal #AddForm #CancelFormBtn',function(e) {
            e.preventDefault();
            $('#AddForm')[0].reset();
            $('#addInteractionModal').modal('hide');
        });
    
        
    
        // Add Interaction
        $(document).on('submit', '#AddForm', function(e) {
    
            e.preventDefault();
            $('#loader').css('display', 'block');
            $("#AddForm button[type=submit]").prop('disabled',true);
            $(".error").remove();
          
            var formData = new FormData(this);

            formData.append('registration_at', $('#registration_at').val());

            var formAction = $(this).attr('action');
            $.ajax({
                url: formAction,
                type: 'POST',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                        $('#addInteractionModal').modal('hide');
                        $('#loader').css('display', 'none');
                        toasterAlert('success', response.message);
                        $('#AddForm')[0].reset();
                        $("#AddForm button[type=submit]").prop('disabled',false);

                        nextPageUrl = "{{ route('loadInteractionList',['uuid'=>$uuid]) }}";

                        $('.interaction-list').html('');
                        getLatestInteraction();
                },
                error: function (xhr) {
                    console.log(xhr);

                    var errors= xhr.responseJSON.errors;
                    console.log(errors);
                    $('#loader').css('display', 'none');
                    for (const elementId in errors) {
                        var errorHtml = '<div><span class="error text-danger">'+errors[elementId]+'</span></';
                        $(errorHtml).insertAfter($("#addInteractionModal #"+elementId));
                    }
                    $("#AddForm button[type=submit]").prop('disabled',false);
                }
            });
        });
    
        
        //Edit Lead functionality

        function getLeadView() {
            var hrefUrl = "{{ route('loadLeadView',['uuid'=>$uuid]) }}";
            $.ajax({
                type: 'get',
                url: hrefUrl,
                dataType: 'json',
                success: function (response) {
                    if(response.success) {
                        $('.lead-view').html(response.htmlView);
                    }
                },
                error: function(res, status, error){
                    console.log(error);
                },
            });
        }

        function initializeBirthDateDatepicker() {
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

        // Open Edit Lead Form Modal
        $(document).on('click','.edit-lead-btn', function(e){
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
                        initializeBirthDateDatepicker();
                    }
                }
            });
        });

        // Start update
        $(document).on('submit', '#editLeadModal #EditForm', function (e) {
            e.preventDefault();
            $("#EditForm button[type=submit]").prop('disabled',true);
            $('#loader').css('display', 'block');
            $(".error").remove();
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
                        $('#editLeadModal').modal('hide');
                        toasterAlert('success', response.message);
                        $('#EditForm')[0].reset();
                        $("#EditForm button[type=submit]").prop('disabled',false);
                        getLeadView();
                    }else{
                        toasterAlert('error', @json(__('messages.error_message')));
                    }
                    $('#loader').css('display', 'none');
                },
                error: function (xhr) {
                    // console.log(xhr);
                    var errors= xhr.responseJSON.errors;
                    console.log(xhr.responseJSON);
                    for (const elementId in errors) {
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

        //Delete Lead functionality
        $(document).on('click', '.lead_delete_btn', function(e) {
            e.preventDefault();
            var formElement = $('.deleteForm');

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
                    formElement.submit();
                }
            });
        });
        

    });
    
    
    
    
    </script>
@endpush