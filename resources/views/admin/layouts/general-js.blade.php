<script>
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    BASE_CRUD.init('{{route('admin.users.find')}}', 'admin.user.formcreateuser')

    function confirm(text, runFunction, dismissFunction)
    {

        var dismissFunction = dismissFunction == undefined ? 
            function(){
                return;
            } : dismissFunction;

        Swal.fire({
            icon: 'warning',
            html: text,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:"Yes",
            cancelButtonText: "No",
        }).then((result) => {
  
            if (result.isConfirmed) {
                runFunction();
            } else if (result.isDenied) {
                dismissFunction();
            }
        });
    }

    function alert(text, type="info")
    {
        Swal.fire({
            icon: type,
            html: text
        });
    }

    function checkEmpty($value,$msgerror="empty")
    {
        if($value != '')
        {
            return true;
        } 
        alert($msgerror);
        return false;
    }

    function alertForm(text, type="info")
    {
        Swal.fire({
            icon: type,
            text: text,
        });

        console.log(text);
        
    }



    

    
    



</script>