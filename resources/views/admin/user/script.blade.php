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
                        alert(data.message,"success");
                        delete_row_datatable($('#dataTable').DataTable(), $("tr[data-id='" + userId +"']"))
                    }else{
                        alert(data.message, "error");
                    }

                },
                error:function(data) {
                    console.log("{{trans('user.something_wrong')}}");

                }
            });
        };

        confirm("{{trans('user.confirm_delete_user')}} ?", runFunction);
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
        var roles = $('.role_checkbox').checked;
        var roles = new Array();
        $('input[name="roles"]:checked').each(function() {
            roles.push(this.value);
        });


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
        formData.append('roles', roles);
          
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
                        alert(res.message,"success");
                        if(userId == null){
                            // DO SOMETHING TO ADD NEW COLLUMN TO DATATABLE
                            console.log('code come here')
                           insert_row_datatable($('#dataTable').DataTable(), res.data.new_row)

                        } else
                        {
                            // DO SOMETHING TO UPDATE OLD COLLUMN
                            update_row_datatable($('#dataTable').DataTable(), $("tr[data-id='" + userId +"']"), res.data.new_row)
                        
                        }
                    } else {
                        alert(res.message,"error");
                    }
                },
                error:function() {
                    console.log("{{trans('user.something_wrong')}}")
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
            alert("{{trans('general.fill_your_field.first_name')}}");
            return false;
        }

        if(!getValueInput("#middle_name",userId)){
            alert("{{trans('general.fill_your_field.middle_name')}}")
            return false;
        }

        if(!getValueInput("#last_name",userId)){
            alert("{{trans('general.fill_your_field.last_name')}}")
            return false;
        }

        if(!getValueInput("#password",userId)){
            alert("{{trans('general.fill_your_field.pass_word')}}")
            return false;
        }

        if(!getValueInput("#repeat_password",userId)){
            alert("{{trans('general.fill_your_field.re_pass_word')}}")
            return false;
        }

        if(getValueInput("#repeat_password",userId) != getValueInput("#password",userId))
        {
            alert("{{trans('general.re_pass_word_wrong')}}")
            return false;
        }

        if(!getValueInput("#email",userId)){
            alert("{{trans('general.fill_your_field.email')}}")
            return false;
        }

        if(!getValueInput("#user_name",userId)){
            alert("{{trans('general.fill_your_field.user_name')}}")
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
        alert("{{trans('general.fill_your_field.param')}}"+$msgerror);
        return false;
    }

    function loadUserEdit(button){
        var button = $(button);
        var user_id = button.data('userid');

        $.ajax({
            url: '{{route("admin.users.find")}}' ,
            type: "POST",
            data:{
                'user_id' : user_id
            },
            
            success: function(res) {
                if(res.status == 404 || res.status == 403)
                {
                    alert(res.message);
                } else {
                    $('#modal-edit-user-content').html(res.data.user_form)
                }
            },
            error: function(){
                alert("{{trans('user.wrong')}}")
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
                console.log("{{trans('user.wrong')}}" + res)
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
                    if(res.status == 404)
                    {
                        alert(res.message)
                    } else {
                        $('#modal-edit-user-content').html(res.data.user_form)
                    }
                },
                error: function(){
                    alert("{{trans('user.wrong')}}")
                },
            })
        },

        modalCreate(paramURL = null, paramURLModal = null){
            let url = (paramURL==null) ? this._urlModalCreate : paramURL;
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
                    alert("{{trans('user.wrong')}}")
                },
            })
        }
    }
    BASE_CRUD.init('{{route('admin.users.find')}}', 'admin.user.formcreateuser');


    DATA_TABLE = {
        _table: null,

        init(table)
        {
           this._table = table;
        },

        create_data_table()
        {
            console.log("create data table");
            table = this._table.DataTable({
                reponsive: false,
                language: {
                    "sLengthMenu": "",
                    "sSearch": "{{trans('general.search')}}",
                    "oPaginate": {
                        "sFirst": "{{trans('general.first')}}",
                        "sPrevious": "{{trans('general.previous')}}",
                        "sNext": "{{trans('general.next')}}",
                        "sLast": "{{trans('general.last')}}"
                    }
                },
                iDisplayLength: 10,
                "columnDefs": [{
                    "searchable": false,
                    "targets": 0
                }],   
            });

            table.columns().every(function () {
                var that = this;
                $('input[type=text]', this.header()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
            table.on('search.dt', function () {
                table.column(0, {search: 'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            this._table = table;

        }
    }
  

</script>
