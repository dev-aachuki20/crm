@extends('layouts.master')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
@endpush
@section('content')
<div class="container">
    <div class="headingbar">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="headingleft">
                    <h2>{{__('cruds.user.title')}}</h2>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="buttongroup-block d-flex justify-content-end">
                    <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#exampleModal">+ {{__('global.add')}} {{__('cruds.new')}} {{__('cruds.user.title_singular')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <h4>{{__('cruds.user.title')}} {{__('global.list')}}</h4>
        {!! $dataTable->table(['class' => 'table mb-0']) !!}

        <!-- pagination -->
        <!-- <nav class="paginationbar mt-5" aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 492 492" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M198.608 246.104 382.664 62.04c5.068-5.056 7.856-11.816 7.856-19.024 0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12C361.476 2.792 354.712 0 347.504 0s-13.964 2.792-19.028 7.864L109.328 227.008c-5.084 5.08-7.868 11.868-7.848 19.084-.02 7.248 2.76 14.028 7.848 19.112l218.944 218.932c5.064 5.072 11.82 7.864 19.032 7.864 7.208 0 13.964-2.792 19.032-7.864l16.124-16.12c10.492-10.492 10.492-27.572 0-38.06L198.608 246.104z" fill="#5c5c63" opacity="1" data-original="#000000"></path>
                                </g>
                            </svg>
                        </span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M382.678 226.804 163.73 7.86C158.666 2.792 151.906 0 144.698 0s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064L293.398 245.9l-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86L382.678 265c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z" fill="#5c5c63" opacity="1" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                        </span>
                    </a>
                </li>
            </ul>
        </nav> -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade new-channel-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>First Name:</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Last Name:</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Rol:</label>
                                        <select class="form-control">
                                            <option>super admin</option>
                                            <option>admininstador</option>
                                            <option>vendedor</option>
                                            <option>supervisor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Birthdate:</label>
                                        <input type="date" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Upload:</label>
                                        <input type="file" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group checboxcont">
                                        <input type="checkbox" name="" class="form-control"> Send password to email
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>Campaign:</label>
                                <div class="listbox">
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>Black Friday</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>Navidad</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>SIN IVA</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>Regreso a Clases</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>Black Friday</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>Navidad</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>SIN IVA</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>Regreso a Clases</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>Black Friday</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>Navidad</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>SIN IVA</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="campaign" class="form-control">
                                        <span>Regreso a Clases</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Channel:</label>
                                <div class="listbox">
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Call Center</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Web</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Whatsapp</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Freelance</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Call Center</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Web</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Whatsapp</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Freelance</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Call Center</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Web</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Whatsapp</span>
                                    </div>
                                    <div class="checboxcont">
                                        <input type="checkbox" name="channel" class="form-control">
                                        <span>Freelance</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-12">
                            <div class="buttonform">
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
{!! $dataTable->scripts() !!}
@endpush