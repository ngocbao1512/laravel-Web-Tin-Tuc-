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
