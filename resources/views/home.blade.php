@extends('layouts.master')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="search-identify">
                <div class="logo text-center"><img src="{{ asset('images/gestiona.svg') }}" class="img-fluid" /></div>
                <form>
                    <div class="inputWrapper position-relative">
                        <input id="search" type="search" name="" class="form-control" placeholder="{{__('cruds.search_by_identification')}}" />
                        <button type="button" class="search"><img src="{{ asset('images/search.svg') }}" class="img-fluid" /></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection