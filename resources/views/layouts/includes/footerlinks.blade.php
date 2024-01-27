<!-- SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $('.selectpicker').selectpicker();
        });
    });
    $('.from_code').select2({
        templateResult: formatState,
        templateSelection: formatStateSelection
    });

    function formatState(state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span class="topd-img flag-img"><img src="' + $(state.element).attr('data-src') + '" class="img-flag" /> ' + state.text + '</span>'
        );
        return $state;
    };

    function formatStateSelection(state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span class="topf-img flag-img"><img src="' + $(state.element).data('src') + '" class="img-flag" /> ' + state.text + '</span>'
        );
        return $state;
    }


    /* $(document).ready(function(){
        $(function(){
            $('.selectpicker').selectpicker();
        });
    });
    $('.from_code').select2({
        templateResult: formatState,
        templateSelection: formatStateSelection
    });
    function formatState(state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span class="topd-img flag-img"><img src="' + $(state.element).attr('data-src') + '" class="img-flag" /> ' + state.text + '</span>'
        );
        return $state;
    };
    function formatStateSelection(state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span class="topf-img flag-img"><img src="' + $(state.element).data('src') + '" class="img-flag" /> ' + state.text + '</span>'
        );
        return $state;
    } */
</script>
@stack('scripts')