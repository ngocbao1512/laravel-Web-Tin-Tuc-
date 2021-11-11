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


    function getFormData()
    {
        var first_name = $('#first_name').val();
        var middle_name = $('#middle_name').val();
        var last_name = $('#last_name').val();
        var password = $('#password').val();
        var repassword = $('#repeat_password').val();
        var email = $('#email').val();
        var username = $('#user_name').val();
        var formData = new FormData();
        if(!checkFormUser()){
            return false;
        }
        formData.append('file', $('#patient_pic')[0].files[0]);
        formData.append('first_name', first_name);
        formData.append('middle_name',middle_name);
        formData.append('last_name',last_name);
        formData.append('password',password);
        formData.append('email',email);
        formData.append('username',username);
       
        return formData;
    }

    function saveData(button, method='save', messageConfirm, userId = null)
    {
        console.log("okok");
        var formData = getFormData();
        if(!formData) return false;
        formData.append('userid',userId);
        console.log(formData);
        var url = ''
        if(method == 'update'){
            url =  "{{ route('admin.users.update') }}"
        }else {
            url = "{{ route('admin.users.store') }}"
        }

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
        
        confirm(messageConfirm + "?", runFunction);
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

    BASE_CRUD = {
        _urlLoadDataItems: null,
        _showModalDetail: null,
        _urlModalCreate: null,
        _userid: null,
        
        
        init(urlLoadDataItems, urlModalCreate, showModalDetail) {
            this._urlLoadDataItems = urlLoadDataItems;  
            this._showModalDetail = showModalDetail;
            this._urlModalCreate = urlModalCreate;
        },

        loadDataItems(paramURL = null, userid = null){
            let url = paramURL;
            if(url === null) url = this._urlLoadDataItems;
            this._userid = userid;
            $.ajax({
                url,
                type: "POST",
                data:{
                    'userid' : userid
                },
                success: function(res) {
                    $('#modal-body').html(res.data.user_form)
                    console.log(res.data.user_form.user)
                },
                error: function(){
                    alert('some thing went wrong. please try again!!!')
                },
            })
        },

        modalCreate(paramURL = null, paramURLModal = null){
            let url = (paramURL==null) ? this._urlModalCreate : paramURL;
            console.log(url);
            let urlModal = (paramURLModal === null ) ? this._urlModalCreate : paramURLModal
            console.log(urlModal)
            $.ajax({
                url,
                type: "POST",
                data: {
                    'urlmodal' : urlModal
                },
                success: function(res) {
                    console.log(res);
                    $('#modal-body').html(res);
                },
                error: function(){
                    alert('some thing went wrong. please try again laster')
                },
            })
        }


    }

    

</script>



  
