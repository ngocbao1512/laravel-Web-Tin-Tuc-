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
                           console.log('ok');              
                        }else if(res.status == 404){
                            alert('no data have been find')
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