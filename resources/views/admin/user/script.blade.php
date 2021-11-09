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
                        console.log('oopp');
                    }

                },
                error:function(data) {
                    console.log('some thing went wrong');

                }
            });
        };

        confirm("Do you want to delete this user ?", runFunction);
    }

    function createUser(button) {
        var first_name = $('#first_name').val();
        if(first_name == ""){
            alert("Empty First Name","error");
            return false;
        }
        var middle_name = $('#middle_name').val();
        var last_name = $('#last_name').val();
        var password = $('#password').val();
        var email = $('#email').val();
        var username = $('#user_name').val();
        var url = "{{ route('admin.users.store') }}";

        var formData = new FormData();
        formData.append('file', $('#patient_pic')[0].files[0]);
        formData.append('first_name', first_name);
        formData.append('middle_name',middle_name);
        formData.append('last_name',last_name);
        formData.append('password',password);
        formData.append('email',email);
        formData.append('username',username);
        

        console.log(formData);
        var runFunction = function() {
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success:function(data) {
                    if(data.status == 200 ){
                        alert(data.message, "success");
                    } else {
                        alert(data.message, "error");
                    }
                },
                error:function(data) {
                    console.log('some thing went wrong')
                },
                async: true,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                timeout: 60000
            });
        };
        
        confirm("do you want to create this user ?", runFunction);
        console.log("okssk");
    }

    function getDataToEdit(button)
    {
        var button = $(button);
    }
    function editUser(button)
    {
        var userId = button.data('userid');
        var username = button.data('username');
        var firstname = button.data('firstname');
        var middlename = button.data('middlename');
        var lastname = button.data

    }

    

</script>



  
