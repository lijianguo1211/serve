<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div>
    <h1 id="onClick">点点</h1>
</div>
</body>

<script src="{{ url('js/jquery-3.1.1.js') }}"></script>

<script>
    $(document).ready(function(){
        $("#onClick").click(function(){
           $.ajax({
                type:"post",
                url:"http://localhost:8009/liyi",
                data:{content: '123456'},
                dataType: 'json',
                success:function(res){
                    console.log(res);
                },
                error:function(res){
                    console.log(res);
               }
           });
        });
    });
</script>
</html>
