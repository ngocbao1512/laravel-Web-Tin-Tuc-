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
                    console.log('{{trans('user.SomethingWrong')}}');

                }
            });
        };

        confirm("{{trans('user.ConfirmDeleteUser')}} ?", runFunction);
    }

    function getValueInput(idGetValue,userId){
        var nameid = idGetValue + "-" + userId;
        var value = $(nameid).val()
        
        if(value){
            return $(nameid).val();
        }
        return false;
    }

    function getFormData(userId)
    {
        var formData = new FormData();
        if(userId != null){
            formData.append('user_id', userId);
        } else {
            userId = 0;
        }
        var first_name = getValueInput('#first_name',userId)
        var middle_name =  getValueInput('#middle_name',userId)
        var last_name =  getValueInput('#last_name',userId)
        var password =  getValueInput('#password',userId)
        var repassword =  getValueInput('#repeat_password',userId)
        var email =  getValueInput('#email',userId)
        var user_name =  getValueInput('#user_name',userId)
        var idInputFile = "#input-avatar-"+userId
        console.log("ok");
        console.log($(idInputFile)[0].files[0]);
        
        if(!checkFormUser(userId)){
            return false;
        }
        
        formData.append('avatar', $(idInputFile)[0].files[0]);
        formData.append('first_name', first_name);
        formData.append('middle_name',middle_name);
        formData.append('last_name',last_name);
        formData.append('password',password);
        formData.append('email',email);
        formData.append('user_name',user_name);
        
       
        return formData;
    }

    function saveData(button, messageConfirm, userId = null)
    {
        if(userId != null){
            url =  "{{ route('admin.users.update') }}";
        }else {
            url = "{{ route('admin.users.store') }}";
        }
        var formData = getFormData(userId);
        if(!formData) return false;

        var runFunction = function() {
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success:function(res) {
                    if(res.status == 200 ){
                        alert(res.message, "success");
                    } else {
                        alert(res.message, "error");
                    }
                },
                error:function() {
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

    function checkFormUser(userId)
    {

        if(!getValueInput("#first_name",userId)){
            alert('fill your field first name');
            return false;
        }

        if(!getValueInput("#middle_name",userId)){
            alert('fill your field middle name')
            return false;
        }

        if(!getValueInput("#last_name",userId)){
            alert('fill your field last name')
            return false;
        }

        if(!getValueInput("#password",userId)){
            alert('fill your field password')
            return false;
        }

        if(!getValueInput("#repeat_password",userId)){
            alert('fill your field repeat password')
            return false;
        }

        if(getValueInput("#repeat_password",userId) != getValueInput("#password",userId))
        {
            alert('check your password and repeat password')
            return false;
        }

        if(!getValueInput("#email",userId)){
            alert('fill your field email')
            return false;
        }

        if(!getValueInput("#user_name",userId)){
            alert('fill your user name')
            return false;
        }

        return true;
    }

    function checkEmpty($value,$msgerror="empty")
    {
        if($value != '')
        {
            return true;
        } 
        alert("please press fill field your "+$msgerror);
        return false;
    }

    function loadUserEdit(paramURL = null, user_id = null){
        BASE_CRUD.__userid;
        let url = paramURL;
        $.ajax({
            url,
            type: "POST",
            data:{
                'user_id' : user_id
            },
            success: function(res) {
                $('#modal-edit-user-content').html(res.data.user_form)
            },
            error: function(){
                alert('some thing went wrong. please try again!!!')
            },
        });
    }

    function changeLanguage(button, language){
        $.ajax({
            url: "{{route('admin.user.change-language')}}",
            type: 'POST', 
            data: {
                'language': language
            },
            success: function(){
                alert('change language suceess');
                window.location.reload();
            },
            error: function(res){
                console.log('some thing went wrong went change language' + res)
            },
        });
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

        loadDataItems(paramURL = null, user_id = null){
            let url = paramURL;
            if(url === null) url = this._urlLoadDataItems;
            this._userid = user_id;
            $.ajax({
                url,
                type: "POST",
                data:{
                    'user_id' : this._userid
                },
                success: function(res) {
                    $('#modal-edit-user-content').html(res.data.user_form)
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
            $.ajax({
                url,
                type: "POST",
                data: {
                    'urlmodal' : urlModal
                },
                success: function(res) {
                    $('#modal-body').html(res);
                },
                error: function(){
                    alert('some thing went wrong. please try again laster')
                },
            })
        }
    }

    BASE_CRUD.init('{{route('admin.users.find')}}', 'admin.user.formcreateuser');

    function initDataTable(table)
    {
        var this_table =  table.DataTable({
            reponsive: false,
            language: {
                "sLengthMenu": "",
                "sSearch": "{{trans('general.Search')}}",
                "oPaginate": {
                    "sFirst": "{{trans('general.First')}}",
                    "sPrevious": "{{trans('general.Previous')}}",
                    "sNext": "{{trans('general.Next')}}",
                    "sLast": "{{trans('general.Last')}}"
                }
            },
            iDisplayLength: 10,
            "columnDefs": [{
                "searchable": false,
                "targets": 0
            }],   
        });

        this_table.columns().every(function () {
            var that = this;
            $('input[type=text]', this.header()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                    .search(this.value)
                    .draw();
                }
            });
        });

        this_table.on('search.dt', function () {
            this_table.column(0, {search: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        return this_table;
    }
</script>
