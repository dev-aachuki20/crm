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
                    <h4 class="text-capitalize">@lang('cruds.home.registration_data')</h4>
                    <div class="datablock">
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.first_name'):</label>
                            <div class="dataitem">{{ $lead->name ? ucfirst($lead->name) : '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.last_name'):</label>
                            <div class="dataitem">{{ $lead->last_name ? ucfirst($lead->last_name) : '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.identification'):</label>
                            <div class="dataitem">{{ $lead->identification ?? '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.birth_date'):</label>
                            <div class="dataitem">{{ $lead->birthdate ?? '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.gender'):</label>
                            <div class="dataitem">{{ isset(config('constants.genders')[$lead->gender]) ? ucfirst(trans('cruds.genders.'.config('constants.genders')[$lead->gender]) ) :''  }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.civil_status'):</label>
                            <div class="dataitem">{{ isset(config('constants.civil_status')[$lead->civil_status]) ? ucfirst(trans('cruds.civil_status.'.config('constants.civil_status')[$lead->civil_status]) ) :''  }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.phone'):</label>
                            <div class="dataitem">{{ $lead->phone ?? '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.cell_phone'):</label>
                            <div class="dataitem">{{ $lead->cellphone ?? '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.email'):</label>
                            <div class="dataitem">{{ $lead->email ?? '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.province'):</label>
                            <div class="dataitem">{{ $lead->province ? ucwords($lead->province) :'' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.city'):</label>
                            <div class="dataitem">{{ $lead->city ? ucwords($lead->city) : '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.address'):</label>
                            <div class="dataitem">{{ $lead->address ? ucwords($lead->address) : '' }}</div>
                        </div>
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

                                <div class="datablock-observationinner">
                                    @foreach($lead->interactions()->orderBy('created_at','desc')->get() as $key=>$interaction)

                                        @if($key != 0)
                                            
                                        <div class="datablock-observation">
                                            <h6>
                                                {{ $lead->identification }} / {{ \Carbon\Carbon::parse($interaction->registration_at)->format('d-m-Y') }} / {{ \Carbon\Carbon::parse($interaction->registration_at)->format('H') }}h{{ \Carbon\Carbon::parse($interaction->registration_at)->format('i') }}
                                            </h6>
                                            <p> {{ nl2br($interaction->customer_observation) }} </p>
                                        </div>

                                        @endif

                                    @endforeach
                                </div>
                                @endif
                               
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="buttongroup-block d-flex justify-content-end">
                               
                                @can('interaction_create')

                                <button type="button" class="btn btn-blue btnsmall addNewInterationBtn" data-href="{{ route('interactions-create', ['lang' => app()->getLocale(),'uuid' => $lead->uuid]) }}">+ {{__('global.add')}} {{__('cruds.interaction.title_singular')}}</button>
                                @endcan

                            </div>
                        </div>
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

        $(document).on('click','.addNewInterationBtn', function(e)
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
            //$(".is-invalid").removeClass('is-invalid');
          
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
                },
                error: function (xhr) {
                    console.log(xhr);

                    var errors= xhr.responseJSON.errors;
                    console.log(errors);
                    $('#loader').css('display', 'none');
                    for (const elementId in errors) {
                        //$("#"+elementId).addClass('is-invalid');
                        var errorHtml = '<div><span class="error text-danger">'+errors[elementId]+'</span></';
                        $(errorHtml).insertAfter($("#addInteractionModal #"+elementId));
                    }
                    $("#AddForm button[type=submit]").prop('disabled',false);
                }
            });
        });
    
    
    });
    
    
    
    
    </script>
@endpush