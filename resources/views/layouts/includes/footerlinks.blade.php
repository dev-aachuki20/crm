<!-- SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    // toggle js
    const toggleBtn = document.querySelector('.toggleBtn')
    const closebtn = document.querySelector('.closebtn')
    const footer = document.querySelector('footer')

    toggleBtn.onclick = () => {
        footer.classList.add('mobilefooter')
    }
    closebtn.onclick = () => {
        footer.classList.remove('mobilefooter')
    }
    // ---------------
    $(document).ready(function() {
        // $('.selectpicker').selectpicker();
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

    $("#makeSearch").validate({
        rules: {
            search: {
                required: false,
                minlength: 16
            },
        },
        messages: {
            search: {
                required: "The search field required.",
                minlength: "The search field must be a valid identification number."
            },
        }
    });

    $(document).on('submit', '#makeSearch', function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            doSearch();
        }
    });

    $(document).on('input','#search',function(e){
        e.preventDefault();
        
        const element = $(".clear-search");
        if($(this).val() == ''){
            element.hide();
        }else{
            element.show();
        }
       
    });


    $(document).on('click','.clear-search',function(e){
        e.preventDefault();
        $('#search').val('');
        $('#search-error').remove();
        @if (request()->routeIs('search*'))
            doSearch();
        @endif
    });

   function doSearch(){
        $('#loader').css('display', 'block');

        var formData = $('#makeSearch').serialize();

        var url = "{{ route('submitSearch',['lang' => app()->getLocale()]) }}";

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(response) {

                $('#loader').css('display', 'none');
                $('#makeSearch .error-message').remove();

                if (response.status === true) {
                   
                    if(response.data.redirectRoute != ''){
                        window.location.href = response.data.redirectRoute;
                    }
                    
                } else {
                    toasterAlert('error', response.message);

                    @if (request()->routeIs('search*'))

                        if(response.data.redirectRoute != ''){
                            window.location.href = response.data.redirectRoute;
                        }
                        
                    @endif
                }
            },
            error: function(response) {
                // console.error('Error submitting form:', response);
                setTimeout(function() {
                    $('#loader').css('display', 'none');
                }, 500);
                $('#makeSearch .error-message').remove();
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('[name="' + key + '"]').after('<span class="error-message text-danger">' + value[0] + '</span>');
                    });
                } else {
                    console.log('An unexpected error occurred. Please try again.');
                }
            }
        });
   }

   
</script>

@include('layouts.includes.alert')

@stack('scripts')