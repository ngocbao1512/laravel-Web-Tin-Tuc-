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
    
     $("#patient_pic").on("change",function(){
        readURL(this,"#preview_image")
    });
    
</script> 

