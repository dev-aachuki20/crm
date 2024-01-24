@extends('layouts.master')
@section('content')
<div class="container">
    <div class="headingbar">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="headingleft">
                    <h2>Campaign</h2>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="buttongroup-block d-flex justify-content-end">
                    <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add Campaign</button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <h4>created Campaign list</h4>
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Campaign</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Web</td>
                    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </td>
                    <td>
                        <div class="edit-delete">
                            <button type="button" class="edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M13.26 3.59997L5.04997 12.29C4.73997 12.62 4.43997 13.27 4.37997 13.72L4.00997 16.96C3.87997 18.13 4.71997 18.93 5.87997 18.73L9.09997 18.18C9.54997 18.1 10.18 17.77 10.49 17.43L18.7 8.73997C20.12 7.23997 20.76 5.52997 18.55 3.43997C16.35 1.36997 14.68 2.09997 13.26 3.59997Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.89 5.05005C12.32 7.81005 14.56 9.92005 17.34 10.2" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3 22H21" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" class="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.33 16.5H13.66" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.5 12.5H14.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Whatsapp</td>
                    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </td>
                    <td>
                        <div class="edit-delete">
                            <button type="button" class="edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M13.26 3.59997L5.04997 12.29C4.73997 12.62 4.43997 13.27 4.37997 13.72L4.00997 16.96C3.87997 18.13 4.71997 18.93 5.87997 18.73L9.09997 18.18C9.54997 18.1 10.18 17.77 10.49 17.43L18.7 8.73997C20.12 7.23997 20.76 5.52997 18.55 3.43997C16.35 1.36997 14.68 2.09997 13.26 3.59997Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.89 5.05005C12.32 7.81005 14.56 9.92005 17.34 10.2" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3 22H21" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" class="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.33 16.5H13.66" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.5 12.5H14.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Facebook</td>
                    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </td>
                    <td>
                        <div class="edit-delete">
                            <button type="button" class="edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M13.26 3.59997L5.04997 12.29C4.73997 12.62 4.43997 13.27 4.37997 13.72L4.00997 16.96C3.87997 18.13 4.71997 18.93 5.87997 18.73L9.09997 18.18C9.54997 18.1 10.18 17.77 10.49 17.43L18.7 8.73997C20.12 7.23997 20.76 5.52997 18.55 3.43997C16.35 1.36997 14.68 2.09997 13.26 3.59997Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.89 5.05005C12.32 7.81005 14.56 9.92005 17.34 10.2" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3 22H21" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" class="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.33 16.5H13.66" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.5 12.5H14.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Call Center</td>
                    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </td>
                    <td>
                        <div class="edit-delete">
                            <button type="button" class="edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M13.26 3.59997L5.04997 12.29C4.73997 12.62 4.43997 13.27 4.37997 13.72L4.00997 16.96C3.87997 18.13 4.71997 18.93 5.87997 18.73L9.09997 18.18C9.54997 18.1 10.18 17.77 10.49 17.43L18.7 8.73997C20.12 7.23997 20.76 5.52997 18.55 3.43997C16.35 1.36997 14.68 2.09997 13.26 3.59997Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.89 5.05005C12.32 7.81005 14.56 9.92005 17.34 10.2" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3 22H21" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" class="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.33 16.5H13.66" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.5 12.5H14.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Freelance</td>
                    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </td>
                    <td>
                        <div class="edit-delete">
                            <button type="button" class="edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M13.26 3.59997L5.04997 12.29C4.73997 12.62 4.43997 13.27 4.37997 13.72L4.00997 16.96C3.87997 18.13 4.71997 18.93 5.87997 18.73L9.09997 18.18C9.54997 18.1 10.18 17.77 10.49 17.43L18.7 8.73997C20.12 7.23997 20.76 5.52997 18.55 3.43997C16.35 1.36997 14.68 2.09997 13.26 3.59997Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.89 5.05005C12.32 7.81005 14.56 9.92005 17.34 10.2" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3 22H21" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" class="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.33 16.5H13.66" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.5 12.5H14.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade new-channel-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Enter the new Campaign</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>Campaign name:</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>Assigned channel:</label>
                                <select class="form-control">
                                    <option>Black Friday</option>
                                    <option>Navidad</option>
                                    <option>SIN IVA</option>
                                    <option>Regreso a Clases</option>
                                    <option>Dia de la madre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>Create by:</label>
                                <input type="text" class="form-control" value="Yesi Tacury" />
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
                                <textarea class="form-control mt-3"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="buttonform">
                                <button type="button" class="btn btn-red btnsmall">Cancle</button>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
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