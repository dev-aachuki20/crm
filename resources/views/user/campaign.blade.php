@extends('layouts.master')
@section('title', 'Campaign')
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
                    <button type="button" class="btn btn-blue btnsmall" data-bs-toggle="modal" data-bs-target="#exampleModal" id="campaign">+ {{__('cruds.add')}} {{__('cruds.campaign.title_singular')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-creating-channel mt-3">
        <h4>{{__('cruds.campaign.title')}} {{__('global.list')}}</h4>
        {!! $dataTable->table(['class' => 'table mb-0']) !!}
    </div>
</div>
<!-- Modal -->
{{-- For creating the Campaign --}}
<div class="modal fade new-channel-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">{{__("cruds.campaign.fields.new_campaign")}}</h5>
                <button type="button" class="btn-close" id="cancelButton" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="saveCampaign" action="" method="">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>{{__("cruds.campaign.fields.campaign_name")}}:</label>
                                <input type="text" class="form-control" name="campaign_name" id="campaign_name" />
                                {{-- @if($errors->has('campaign_name'))
                                    <span style="color: red;">{{ $errors->first('campaign_name') }}</span>
                                @endif --}}
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
                                <!-- <input type="text" id="newTag" class="form-control" /> -->
                                <div class="input-group">
                                    <input type="text" id="newTag" class="form-control" />
                                    <input type="button" class="input-group-text btn btn-blue btnsmall shadow-none" id="addOption" value="+ {{__('cruds.add')}}" />
                                </div>
                                <!-- <textarea class="form-control mt-3"></textarea> -->
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <div class="tags">
                                    <ul id="tagList">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>{{__("cruds.campaign.fields.description")}}:</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="buttonform">
                                <button type="button" class="btn btn-red btnsmall" onclick="cancelForm()" id="cancelButton" data-bs-dismiss="modal" aria-label="Close">{{__('cruds.cancel')}}</button>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="buttonform text-end">
                                <button type="button" class="btn btn-green btnsmall" onclick="submitForm()">{{__('cruds.save')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- For Updating the Campaign --}}
<div class="modal fade new-channel-popup" id="updateCampaignModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">{{__("cruds.campaign.fields.new_campaign")}}</h5>
                <button type="button" class="btn-close" id="" {{-- data-bs-dismiss="modal" aria-label="Close" --}} onclick="closeTheEditPopup()"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="updateCampaign" action="" method="">
                    @csrf
                    <input type="hidden" name="campaign_id" id="campaign_id" value="" />
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>{{__("cruds.campaign.fields.campaign")}}:</label>
                                <input type="text" class="form-control" name="campaign_name" id="campaign_name_update" />
                                {{-- @if($errors->has('campaign_name'))
                                    <span style="color: red;">{{ $errors->first('campaign_name') }}</span>
                                @endif --}}
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>{{__("cruds.campaign.fields.assigned_channel")}}:</label>
                                <select class="form-control" name="assigned_channel" id="assigned_channel_update">
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
                                <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="created_by_update" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group qualificationGroup">
                                <label>{{__("cruds.campaign.fields.qualification")}}:</label>
                                <!-- <input type="text" id="newTag" class="form-control" /> -->
                                <div class="input-group">
                                    <input type="text" id="newTag" class="form-control" />
                                    <input type="button" class="input-group-text btn btn-blue btnsmall shadow-none" id="addOption" value="+ {{__('cruds.add')}}" />
                                </div>
                                <!-- <textarea class="form-control mt-3"></textarea> -->
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <div class="tags">
                                    <ul id="tagList">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>{{__("cruds.campaign.fields.description")}}:</label>
                                <textarea class="form-control" name="description" id="description_update"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="buttonform">
                                <button type="button" class="btn btn-red btnsmall" id="" onclick="closeTheEditPopup()">Cancel</button>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="buttonform text-end">
                                <button type="button" class="btn btn-green btnsmall" onclick="updateCampaign()">Save</button>
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
<!-- Select Tags Js -->
<script>

</script>
{!! $dataTable->scripts() !!}
<script>
    var tagList = [];
    var $tagList = $("#tagList");
    var $newTag = $("#newTag");

    tagList_render();

    function tagList_render() {
        $tagList.empty();
        tagList.map(function(_tag) {
            var temp = '<li>' + _tag + '<span class="rmTag">&times;</span></li>';
            $tagList.append(temp);
        });
    }

    tagList_render();
    // ADD JQUERY
    $(document).ready(function() {
        /* var tagList = ['Optimus Prime', 'Bumblebee', 'Megatron', 'Ironhide']; */
        // var tagList = [];


        // cacheing the DOM elements
        /* var $tagList = $("#tagList");
        var $newTag = $("#newTag"); */

        // initial render
        // tagList_render();
        // always put logic sections and render sections in seperate functions/class
        // trust me it will help a lot on big projects!
        /* function tagList_render () {
            $tagList.empty();
            tagList.map (function (_tag) {
                var temp = '<li>'+ _tag +'<span class="rmTag">&times;</span></li>';
                $tagList.append(temp);
            });
        }; */
        jQuery("#addOption").click(function() {
            var newTag = $("#newTag").val();
            if (newTag.replace(/\s/g, '') !== '') {
                tagList.push(newTag);
                $newTag.val('');
                tagList_render();
            }
        });
        // button events
        // Remove Tag
        $tagList.on("click", "li>span.rmTag", function() {
            var index = $(this).parent().index();
            tagList.splice(index, 1);
            tagList_render();
        });
    });

    /* For Submit the campaign */
    function submitForm() {
        $('.error').remove();
        var formData = $('#saveCampaign').serialize();
        var appLanguage = "{{ app()->getLocale() }}";

        formData += "&tagList=" + encodeURIComponent(JSON.stringify(tagList));

        $.ajax({
            type: 'POST',
            url: "{{route('getCampaignStore')}}",
            data: formData,
            success: function(response) {
                if (response.status === true) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 200);
                } else {
                    toastr.error(response.error);
                }
            },
            error: function(response) {
                console.error('Error submitting form:', response);
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('[name="' + key + '"]').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                    });
                } else {
                    alert('An unexpected error occurred. Please try again.');
                }
            }
        });
    }

    function openUpdateCampaignModal(campaign_id) {
        $('#updateCampaign .error').remove();

        var url = "{{ url('/campaign-edit') }}";
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                id: campaign_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === true) {
                    $('#updateCampaignModal').modal('show');

                    $('#campaign_id').val(campaign_id);
                    $('#campaign_name_update').val(response.data.campaign_name);
                    $('#assigned_channel_update').val(response.data.assigned_channel);

                    if (response.data && response.data.tag_lists && response.data.tag_lists.tag_name) {
                        // tagList = response.data.tag_lists.tag_name;
                        var parsedTags = JSON.parse(response.data.tag_lists.tag_name);
                        tagList.push(...parsedTags);
                        tagList_render();
                    } else {
                        tagList = [];
                        tagList_render();
                    }

                    $('#created_by_update').val(response.data.created_by);
                    $('#description_update').val(response.data.description);

                    $tagList.empty();
                    tagList.map(function(_tag) {
                        var temp = '<li>' + _tag + '<span class="rmTag">&times;</span></li>';
                        $tagList.append(temp);
                    });
                    console.log(tagList);

                } else {
                    toastr.error(response.error);
                }
            },
            error: function(error) {
                console.error(error);
            }
        });

    }

    function updateCampaign() {
        $('.error').remove();
        var formData = $('#updateCampaign').serialize();

        formData += "&tagList=" + JSON.stringify(tagList);

        $.ajax({
            type: 'POST',
            url: "{{route('getCampaignUpdate')}}",
            data: formData,
            success: function(response) {
                if (response.status === true) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 200);
                } else {
                    toastr.error(response.error);
                }
            },
            error: function(response) {
                console.error('Error updating form:', response);
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('[name="' + key + '"]').after('<span class="error" style="color: red;">' + value[0] + '</span>');
                    });
                } else {
                    alert('An unexpected error occurred. Please try again.');
                }
            }
        });
    }

    function deleteCompaign(userId) {
        var url = "{{ url('/campaign/delete') }}";
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                id: userId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === true) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 200);
                } else {
                    toastr.error(response.error);
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    $('#cancelButton').click(function() {
        $('#saveCampaign')[0].reset();
        // var tagList = [];
        $tagList.empty();
        /* setTimeout(function () {
            location.reload();
        }, 10); */
    });

    function closeTheEditPopup() {
        var tagList = [];
        $tagList.empty();
        $('#updateCampaignModal').modal('hide');
        /* setTimeout(function () {
            location.reload();
        }, 10); */
    }

    $('#campaign').click(function() {
        $('#saveCampaign .error').remove();
    });
</script>
@endpush