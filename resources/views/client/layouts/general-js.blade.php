<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function changeLanguage(button, language){
        $.ajax({
            url: "{{route('admin.user.change-language')}}",
            type: 'POST',
            data: {
                'language': language
            },
            beforeSend: function() {
                // setting a timeout
                $("#loading").show();
            },
            success: function(){
                $("#loading").hide();
                alert('change language suceess');
                window.location.reload();
            },
            error: function(res){
                $("#loading").hide();
                console.log("{{trans('user.wrong')}}" + res)
            },
        });
    }
    
    function alert(text, type="info")
    {
        Swal.fire({
            icon: type,
            html: text
        });
    }  
</script>