<div class="modal fade new-channel-popup" id="editLeadModal" tabindex="-1" aria-labelledby="addLeadLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="addLeadLabel">{{__('cruds.edit')}} {{__('cruds.lead.title_singular')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="EditForm" action="{{ route('updateLead',['lead' => $lead->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('lead.form')
                </form>
            </div>
        </div>
    </div>
</div>
