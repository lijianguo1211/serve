<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
<body>
    <div class="title">
        <p>@{{ message }}</p>
        <input v-model="message">
        <button v-on:click="onMessage">反馈消息</button>
        <ul>
            <li v-for="todo in todos">
                @{{ todo.text }}
            </li>
        </ul>
    </div>


    {{--script--}}
    <script type="text/javascript" src="{{asset('js/vue.js')}}"></script>
    <script type="text/javascript">
        new Vue({
            el: ".title",
            data : {
                message: "Hello Laravel !",
                todos:[
                    {text:"laravel"},
                    {text:"vue.js"},
                    {text:"php"}
                ]
            },
            methods:{
                onMessage:function() {
                    this.message = this.message.split('').reverse().join('')
                }
            }
        })
    </script>
</body>
</html>
