@extends('layouts.master')
@section('title', __('cruds.home.title'))
@section('content')
<!-- Loader element -->
<div id="loader">
    <div class="spinner"></div>
</div>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="search-identify">
                <div class="logo text-center"><img src="{{ asset('images/gestiona.svg') }}" class="img-fluid" /></div>
                <form id="makeSearch">
                    @csrf
                    <div class="inputWrapper position-relative">
                        <input id="search" type="text" name="search" class="form-control" placeholder="{{__('cruds.search_by_identification')}}" autocomplete="off"/>
                        <button type="button" class="ajax-click clear-search"><img src="{{asset('images/close-wocircle.svg')}}" class="img-fluid" /></button>
                        <button type="submit" class="search"><img src="{{ asset('images/search.svg') }}" class="img-fluid" /></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection