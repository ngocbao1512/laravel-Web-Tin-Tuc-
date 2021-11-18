<script>
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function readURL(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var image_target = $(target);
            reader.onload = function (e) {
                image_target.attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
         }
    }

    function initReadImage(input){
        var targetId = $(input).attr('target-id');
        console.log(targetId, input);
        readURL(input, targetId);
    }



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

    function removeColumn(table, row)
    {
        myTable.row( row ).delete();
    }



</script>
