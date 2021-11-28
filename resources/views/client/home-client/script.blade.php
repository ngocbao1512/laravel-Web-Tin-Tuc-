<script>
    function searchPost(event,input)
    {
        if (event.keyCode === 13) {
            //console.log(input.value)
            var data = input.value;
            var runFunction = function(){
                $.ajax({
                    url: '{{route("client.posts.find")}}',
                    type: 'POST',
                    data: {
                        'data': data
                    },
                    success:function(res) {
                    
                        if(res.status == 200){
                           console.log(res.data);  
                           $('#content-main').html(res.data.blogs)            
                        }else if(res.status == 404){
                            $('#content-main').html('no data response') 
                        } else {
                            console.log('some thing went wrong went you search post')
                        }
    
                    },
                    error:function(res) {
                        console.log('ko coks du lieuy traf vbe ')
                    }
                });
            };

            runFunction();
        }
    }

   
</script>