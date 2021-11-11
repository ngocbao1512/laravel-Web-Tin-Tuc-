<script>
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
        var targetId = input.data(targetId);
        readURL(input, targetId);
    }

    
</script> 

