@extends('layouts.master')
@section('title', __('cruds.campaign.title'))
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
@endpush
@section('content')
<div class="container">
    <div class="headingbar">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="headingleft">
                    <h2>{{__('cruds.campaign.title')}}</h2>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="buttongroup-block d-flex justify-content-end">
                    <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#compaignModal" id="campaign">+ {{__('cruds.add')}} {{__('cruds.campaign.title_singular')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <h4>{{__('cruds.campaign.title')}} {{__('global.list')}}</h4>
        <div class="listing-table">
            {!! $dataTable->table(['class' => 'table mb-0']) !!}
        </div>
    </div>
</div>

<!-- Loader element -->
<div id="loader">
    <div class="spinner"></div>
</div>


<!-- Modal -->
{{-- For creating the Campaign --}}
<div class="modal fade new-channel-popup" id="compaignModal" tabindex="-1" aria-labelledby="compaignModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="compaignModalLabel">{{__("cruds.campaign.fields.new_campaign")}}</h5>
                <button type="button" class="btn-close cancelButton" id="cancelButton" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="saveCampaign">
                    @csrf
                    <input type="hidden" id="campaign_id" name="campaign_id" value="">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>{{__("cruds.campaign.fields.campaign_name")}}:</label>
                                <input type="text" class="form-control" name="campaign_name" id="campaign_name" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>{{__("cruds.campaign.fields.assigned_channel")}}:</label>
                                <select class="form-control" name="assigned_channel" id="assigned_channel">
                                    <option value="">Select the channel</option>
                                    @forelse ($allChannel as $item)
                                    <option value="{{$item->id}}">{{$item->channel_name}}</option>
                                    @empty
                                    <option value="">Data Not Available</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>{{__("cruds.campaign.fields.created_by")}}:</label>
                                <input type="text" class="form-control" value="{{Auth::user()->name}}" readonly />
                                <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="created_by" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group qualificationGroup">
                                <label>{{__("cruds.campaign.fields.qualification")}}:</label>
                                <div class="input-group">
                                    <input type="text" id="newTag" class="form-control" />
                                    <input type="button" class="input-group-text btn btn-blue btnsmall shadow-none" id="addOption" value="+ {{__('cruds.add')}}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <div class="tags">
                                    <ul id="tagList">

                                    </ul>
                                </div>
                                <span id="qualificationError" style="display: none; color: red; display:none;">{{__("cruds.campaign.fields.qualification_field_required")}}</span>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>{{__("cruds.campaign.fields.description")}}:</label>
                                <textarea class="form-control" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="buttonform">
                                <button type="button" class="btn btn-red btnsmall cancelButton" id="cancelButton" data-bs-dismiss="modal" aria-label="Close">{{__('cruds.cancel')}}</button>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="buttonform text-end">
                                <button type="submit" id="saveupdate" class="btn btn-green btnsmall">{{__('cruds.save')}}</button>
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
{!! $dataTable->scripts() !!}
<script>
    var tagList = [];
    var tagListVal = $("#tagList");
    var newTag = $("#newTag");
    tagList_render();

    $(document).on('click', '#campaign', function(e){
        e.preventDefault();
        tagList = [];
    });


    function tagList_render() {
        tagListVal.empty();
        tagList.map(function(_tag) {
            var temp = '<li>' + _tag + '<span class="rmTag">&times;</span></li>';
            tagListVal.append(temp);
        });
    }
    tagList_render();

    $(document).ready(function() {

        $("#addOption").click(function() {
            var newTagVal = $("#newTag").val();
            if (newTagVal.replace(/\s/g, '') !== '') {
                tagList.push(newTagVal);
                newTag.val('');
                tagList_render();
            }
        });

        // Remove Tag
        tagListVal.on("click", "li>span.rmTag", function() {
            var index = $(this).parent().index();
            tagList.splice(index, 1);
            tagList_render();
        });
    });

    
    $(document).on('submit','#saveCampaign',function(e){
        e.preventDefault();
    
        $('#loader').css('display', 'block');

        var formData = $('#saveCampaign').serialize();
        var campaignId = $('#campaign_id').val();

        var qualification = JSON.stringify(tagList);
        var qualificationErrorSpan = document.getElementById('qualificationError');
        if (qualification === '[]') {
            if (qualificationErrorSpan) {
                setTimeout(() => {
                    qualificationErrorSpan.style.display = 'block';
                }, 200);
            }
        }else {
            if (qualificationErrorSpan) {
                qualificationErrorSpan.style.display = 'none';
            }
            formData += "&tagList=" + encodeURIComponent(qualification);
        }

        var url = (campaignId) ? "{{ route('getCampaignUpdate') }}" : "{{ route('getCampaignStore') }}";

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(response) {

                $('#loader').css('display', 'none');
                
                if (response.status === true) {
                    $('#saveCampaign')[0].reset();
                    $('#campaign_id').val('');
                    
                    $('#compaignModal').modal('hide');

                    toasterAlert('success',response.message);

                    refreshDataTable();
                } else {
                    toasterAlert('error',response.message);
                }
            },
            error: function(response) {
                // console.error('Error submitting form:', response);
                setTimeout(function() {
                    $('#loader').css('display', 'none');
                }, 500);
                $('#saveCampaign .error').remove();
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('[name="' + key + '"]').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                    });
                } else {
                    console.log('An unexpected error occurred. Please try again.');
                }
            }
        });
    });
   
    function editForm(campaign_id) {
        tagList = [];
        $('#saveCampaign .error').remove();
        $.ajax({
            type: 'GET',
            url: "{{ route('getCampaignEdit') }}",
            data: {
                id: campaign_id,
            },
            success: function(response) {
                if (response.status === true) {
                    $('#compaignModal').modal('show');

                    $('#campaign_id').val(campaign_id);
                    $('#campaign_name').val(response.data.campaign_name);
                    $('#assigned_channel').val(response.data.assigned_channel);

                    if (response.data && response.data.tag_lists && response.data.tag_lists.tag_name) {
                        var parsedTags = JSON.parse(response.data.tag_lists.tag_name);
                        tagList.push(...parsedTags);
                        tagList_render();
                    } else {
                        tagList = [];
                        tagList_render();
                    }

                    $('#created_by').val(response.data.created_by);
                    $('#description').val(response.data.description);

                    tagListVal.empty();
                    tagList.map(function(_tag) {
                        var temp = '<li>' + _tag + '<span class="rmTag">&times;</span></li>';
                        tagListVal.append(temp);
                    });
                    // console.log(tagList);

                    // Change the button text create to "Update"
                    $('#saveupdate').text("{{__('global.update')}}");
                    $('#compaignModalLabel').text("{{__('global.update')}} {{__('cruds.campaign.title_singular')}}")
                } else {
                    toasterAlert('error',response.message);
                }
            },
            error: function(error) {
                console.error(error);
            }
        });

    }

    function deleteCompaign(campaign_id) {
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
                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('campaign_delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: campaign_id,
                    },
                    success: function(response) {
                        if (response.status === true) {

                            toasterAlert('success',response.message);

                            refreshDataTable();
                           
                        } else {
                            toasterAlert('warning',response.message);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    }

    $('.cancelButton').click(function() {
        $('#saveCampaign')[0].reset();
        var qualificationErrorSpan = document.getElementById('qualificationError');
        if (qualificationErrorSpan) {
            qualificationErrorSpan.style.display = 'none';
        }
    });

    $('#campaign').click(function() {
        $('#tagList').empty();
        $('#saveCampaign .error').remove();
        $('#saveupdate').text("{{__('global.save')}}");
        $('#compaignModalLabel').text("{{__('global.add')}}  {{__('cruds.campaign.title_singular')}}")
    });

    function refreshDataTable() {
        $('#campaigns-table').DataTable().draw();
    }
</script>
@endpush