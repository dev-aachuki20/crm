@extends('layouts.master')
@section('title', __('cruds.home.title'))
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
                            <div class="dataitem">{{ $lead->province ?? '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.city'):</label>
                            <div class="dataitem">{{ $lead->city ?? '' }}</div>
                        </div>
                        <div class="datablockitem">
                            <label>@lang('cruds.lead.fields.address'):</label>
                            <div class="dataitem">{{ $lead->address ?? '' }}</div>
                        </div>
                    </div>
                </div>
                <div class="observation-data">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <div class="datablock-observation">
                                <h6>0924033228 / 14 - 11 - 2023 / 16h00</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id sapien quam. Nulla tempus odio at ipsum ultricies pellentesque. Duis et risus bibendum, molestie purus non, placerat justo. Praesent facilisis mauris eu sollicitudin auctor. Quisque commodo blandit lacus, vitae porttitor mi consectetur eget.</p>
                                <ul class="mb-0 list-unstyled">
                                    <li>Observation: <span>12</span></li>
                                    <li>Campaigns: <span>Black Friday</span></li>
                                    <li>Channel: <span>Whatsapp</span></li>
                                    <li>Create: <span>Yesi Tacury</span></li>
                                </ul>
                                <div class="datablock-observationinner">
                                    <div class="datablock-observation">
                                        <h6>0924033228 / 14 - 11 - 2023 / 16h00</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id sapien quam. Nulla tempus odio at ipsum ultricies pellentesque. Duis et risus bibendum, molestie purus non, placerat justo. Praesent facilisis mauris eu sollicitudin auctor. Quisque commodo blandit lacus, vitae porttitor mi consectetur eget.</p>
                                    </div>
                                    <div class="datablock-observation">
                                        <h6>0924033228 / 14 - 11 - 2023 / 16h00</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id sapien quam. Nulla tempus odio at ipsum ultricies pellentesque. Duis et risus bibendum, molestie purus non, placerat justo. Praesent facilisis mauris eu sollicitudin auctor. Quisque commodo blandit lacus, vitae porttitor mi consectetur eget.</p>
                                    </div>
                                    <div class="datablock-observation">
                                        <h6>0924033228 / 14 - 11 - 2023 / 16h00</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id sapien quam. Nulla tempus odio at ipsum ultricies pellentesque. Duis et risus bibendum, molestie purus non, placerat justo. Praesent facilisis mauris eu sollicitudin auctor. Quisque commodo blandit lacus, vitae porttitor mi consectetur eget.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="buttongroup-block d-flex justify-content-end">
                                <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#observationpopup">+ Add Observation</button>
                            </div>
                        </div>
                    </div>
                </div>
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

</div>
@endsection