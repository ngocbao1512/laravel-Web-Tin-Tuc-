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
        var middle_name = $('#middle_name').val();
        var last_name = $('#last_name').val();
        var password = $('#password').val();
        var repassword = $('#repeat_password').val();
        var email = $('#email').val();
        var username = $('#user_name').val();
        if(!checkFormUser()){
            return false;
        }
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
    }

    function editUser(button)
    {
        var button = $(button)
        var userId = button.data('userid');
        
        var runFunction = function(){
            $.ajax({
                url: '{{route("admin.users.find")}}',
                type: 'POST',
                data: {
                    'userid' : userId,
                },
                success:function(data){
                    if(data.status==200){
                        
                    }else{

                    }

                },
                error:function(data){
                    console.log('some thing went wrong');
                }
            })
        } 

    }

    function checkFormUser()
    {

        if(!checkEmpty($('#first_name').val(), 'please press fill field your first name')){
            return false;
        }

        if(!checkEmpty($('#middle_name').val(), 'please press fill field your middle name')){
            return false;
        }

        if(!checkEmpty($('#last_name').val(), 'please press fill field your last name')){
            return false;
        }

        if(!checkEmpty($('#password').val(), 'please press fill field your password')){
            return false;
        }

        if($('#repeat_password').val() != $('#password').val()){
            alert("some thing wrong in your password. let press again!!");
            return false;
        }

        if(!checkEmpty($('#email').val(), 'please press fill field your email')){
            return false;
        }

        if(!checkEmpty($('#user_name').val(), 'please press fill field your user name')){
            return false;
        }

        return true;
    }

    

</script>



  
