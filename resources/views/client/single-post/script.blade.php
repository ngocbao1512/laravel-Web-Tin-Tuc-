<script>

    function loadComment(){
        var blog_id = '{{$blog_id}}'
        var url = "{{route('client.posts.getcomment')}}";
        var runFunction = function() {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'blog_id' : blog_id,
                },
                success:function(res) {
                    if(res.status == 200 ){
                       
                        console.log('okeeee')
                    } else if(res.status == 400) {
                        $('#comment').html('this blog have not any comment');
                    } else {
                        alert('some thing went wrong');
                    }
                },
                error:function() {
                    console.log('some error occur');
                },
            });
        };
       runFunction();

    };

    setTimeout(function() {
        loadComment();

    },5000);
    
    console.log('ok');
    function Commentable(blog_id)
    {
        console.log('ok');
        var email = $("input[name='email']").val();
        var user_name = $("input[name='user_name']").val();
        var comment = $("#comment_message").val();
        var url = "{{route('client.posts.comment')}}";
        var runFunction = function() {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'email' : email,
                    'user_name' : user_name,
                    'content' : comment,
                    'blog_id' : blog_id,
                },
                success:function(res) {
                    $("input").val("");
                    $("#comment_message").val("");
                    $('#comment').html(res.data.comments) 
                    if(res.status == 200 ){
                        $('#comment').html(res.data.comments) 
                    } else if(res.status == 400) {
                        $('#comment').html('this blog have not any comment');
                    } else {
                        alert('some thing went wrong');
                    }
                },
                error:function() {
                    console.log('some error occur');
                },
            });
        };
       runFunction();
    }

    
    

    
</script>