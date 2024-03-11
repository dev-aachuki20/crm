@extends('layouts.master')
@section('title', __('cruds.interaction.title'))

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@section('content')
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
            {!! $dataTable->table(['class' => 'table mb-0']) !!}
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade new-channel-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Interactions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="form-group">
                                <label>Registration date:</label>
                                <input type="datetime-local" class="form-control" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group">
                                <label>Identification:</label>
                                <input type="text" class="form-control" value="0924033228" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group">
                                <label>Campaign:</label>
                                <input type="text" class="form-control" value="Black friday" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group">
                                <label>Channel:</label>
                                <input type="text" class="form-control" value="Call center externo" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>Qualification:</label>
                                <select class="form-control">
                                    <option>Do not anwser the phone many time.</option>
                                    <option>Do not anwser the phone many time.</option>
                                    <option>Do not anwser the phone many time.</option>
                                    <option>Do not anwser the phone many time.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>Customer observation:</label>
                                <textarea class="form-control">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="buttonform">
                                <button type="button" class="btn btn-red btnsmall">Cancle</button>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="buttonform text-end">
                                <button type="button" class="btn btn-green btnsmall">Save</button>
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
{!! $dataTable->scripts() !!}

@endpush
