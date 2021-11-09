<script>

    function deleteUser(button){
        var button = $(button);
        var userId = button.data('userid');

        var runFunction = function(){
            $.ajax({
                url: '{{route("admin.users.destroy")}}',
                type: 'POST',
                data: {
                    'user_id': userId
                },
                success:function(data) {
                    
                    if(data.status == 200){
                        alert(data.message, "success");

                        // TODOSOMETHING
                    }else{
                        alert(data.message, "error");
                    }

                },
                error:function(data) {
                    console.log('some thing went wrongkkk');

                }
            });
        };

        confirm("Do you want to delete this user ?", runFunction);
    }

</script>