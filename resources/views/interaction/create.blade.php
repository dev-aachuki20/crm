<div class="modal fade new-channel-popup" id="addInteractionModal" tabindex="-1" aria-labelledby="addInteractionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="addInteractionLabel">{{__('cruds.add')}} {{__('cruds.interaction.title_singular')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="new-channel" id="AddForm" action="{{route('interactions-store')}}" method="POST" enctype="multipart/form-data">
                    @include('interaction.form')
                </form>
            </div>
        </div>
    </div>
</div>
