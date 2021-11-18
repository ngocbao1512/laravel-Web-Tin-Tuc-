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
  
    function getValueInput(idGetValue,blogId){
        var nameid = idGetValue + "-" + blogId;
        var value = $(nameid).val()
       
        if(value){
            return value;
        }
        return false;
    }
  
    function getFormData(blogId)
    {
        var formData = new FormData();
        if(blogId != 0){
            formData.append('blog_id', blogId);
        } else {
            blogId = 0;
        }
        var title = getValueInput('#title',blogId)
        var content = CKEDITOR.instances["content-" + blogId].getData();
        console.log(typeof content)
        var publish_date =  getValueInput('#publish_date',blogId)
        var idInputFile = "#input-avatar-"+blogId
       
       
        if(!checkFormBlog(blogId)) return false;
       
        formData.append('cover', $(idInputFile)[0].files[0]);
        formData.append('title', title);
        formData.append('content',content);
        formData.append('publish_date',publish_date);
         
        return formData;
    }
  
    function saveData(button, messageConfirm, blogId = 0)
    {
       /* var data = CKEDITOR.instances["content-" + blogId].getData();
        console.log(data);
        console.log('ok');*/
        if(blogId != 0){
            url =  "{{ route('admin.blogs.update') }}";
        }else {
            url =  "{{ route('admin.blogs.store') }}";
        }
        var formData = getFormData(blogId);
        if(!formData) {
            return false;
        }
  
        var runFunction = function() {
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success:function(res) {
                    if(res.status == 200 ){
                        alert(res.message,"success");
                        if(blogId == 0){
                            // DO SOMETHING TO ADD NEW COLLUMN TO DATATABLE
                           insert_row_datatable($('#dataTable').DataTable(), res.data.new_row)
  
                        } else
                        {
                            // DO SOMETHING TO UPDATE OLD COLLUMN
                            update_row_datatable($('#dataTable').DataTable(), $("tr[data-id='" + blogId +"']"), res.data.new_row)
                       
                        }
                    } else {
                        alert(res.message,"error");
                    }
                },
                error:function() {
                    console.log("{{trans('blog.something_wrong')}}")
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
  
    function checkFormBlog(blogId)
    {
  
        if(!getValueInput("#title",blogId)){
            alert("{{trans('general.fill_your_field.title')}}");
            return false;
        }
  
        if(CKEDITOR.instances["content-" + blogId].getData() == ''){
            alert("{{trans('general.fill_your_field.content')}}")
            return false;
        }
  
        if(!getValueInput("#publish_date",blogId)){
            alert("{{trans('general.fill_your_field.publish_date')}}")
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
                if(res.status == 404)
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
  
    //DATA_TABLE.init($('#dataTable'));
    //DATA_TABLE.create_data_table();
  
  
  
    //============================================================================//
    //============================== FUNCTION DATATABLE ==========================\\
    //============================================================================//
  
    function initDataTable(table)
    {
        var this_table =  table.DataTable({
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
  
        this_table.on('order.dt search.dt', function () {
            this_table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
  
       
        this_table.data('datatable', table);
            table.on('change', function () {
            this_table.data('datatable', table);
        });
  
        return this_table;
    }
  
    initDataTable($('#dataTable'))
  
    //==============================
   
    function insert_row_datatable(table, row_html, prepend = true) {
  
        if (table == undefined)
            return false;
  
        if (table.row == undefined)
            table = table.data('datatable');
  
        table.row.add($(row_html)).draw();
  
  
        var currentPage = table.page();
  
        //refresh the page
        table.page(currentPage).draw(false);
    }
  
    function update_row_datatable(table, row_element, new_html) {
  
        if (table.row == undefined)
            table = table.data('datatable');
  
        if (table == undefined)
            return false;
  
        var row_id = row_element.attr('id');
  
        var data_row = make_data_row_for_datatable(new_html);
        table.row('#' + row_id).data(data_row).draw();
  
    }
  
    function make_data_row_for_datatable(row_html) {
  
        var cells = $(row_html)[0].cells;
  
        var data_row = [];
  
        for (let cell of cells) {
            data_row.push(cell.innerHTML);
        }
       
  
        return data_row;
    }
  
    function delete_row_datatable(table, row_element) {
  
        if (table.row() == undefined)
            table = table.data('datatable');
  
        if (table == undefined)
            return false;
  
        var row_id = row_element.attr('id');
  
        table.row('#' + row_id).remove().draw();
    }
  
 </script>
 
