@extends('layouts.master')
@section('title','Import Leads')
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
                    
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <div class="d-flex justify-content-between">
            <h4>Import Leads</h4>
        </div>

        <div class="listing-table">
            <form class="new-channel" id="AddForm" action="{{ route('submit.importLeads') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    
                    <div class="col-12 col-lg-4">
                        <div class="form-group mb-0">
                            <input type="file" class="form-control" name="file" id="importLeads"/>
                        </div>
                        @error('file')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                 
                    <div class="col-auto">
                        <div class="buttonform text-end">
                            <button type="submit" class="btn btn-green btnsmall">{{ __('global.save') }}</button>
                        </div>
                    </div>
                </div>




            </form>
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

<script>
$(document).ready(function(){


  
});

</script>
@endpush
