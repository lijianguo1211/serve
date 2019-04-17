@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>分类列表</legend>
    </fieldset>
    <div class="table-header">
        <a href="{{url('admin/type/create')}}">
            <i class="menu-icon fa fa-plus orange"></i>
            <span class="menu-text orange"> 添加分类 </span>
        </a>
    </div>
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>ID</th>
                <th>分类名</th>
                <th>父ID</th>
                <th>添加时间</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $vo)
                <tr>
                    <td>{{$vo->id}}</td>
                    <td>{{str_repeat('--',$vo->level)}}{{$vo->name}}</td>
                    <td>{{$vo->pid}}</td>
                    <td>{{$vo->created_at}}</td>
                    <td>{{$vo->updated_at}}</td>
                    <td>
                        <div class="hidden-sm hidden-xs action-buttons">
                            <a class="blue" href="{{ url('/admin/type/'.$vo->id) }}">
                                <i class="ace-icon fa fa-search-plus bigger-130"></i>
                            </a>

                            <a class="green" href="{{ url('/admin/type/'.$vo->id.'/edit') }}">
                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                            </a>

                            <a class="red" href="javascript:void(0);" onclick="del({{$vo->id}})">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script>
        function del(id) {
            var url = "{{url('admin/type_del')}}/"+id;
            layer.confirm('确认删除?',{
                btn: ['确定','取消'] //按钮
            },function(){
                $.ajax({
                    url:url,
                    type:'get',
                    success:function (resn) {
                        console.log(resn);
                        var res = JSON.parse(resn);
                        if(res.status == 1){
                            layer.msg( res.msg, {icon: 1});
                            location.href = "{{url('admin/type')}}";
                        }else {
                            layer.msg( res.msg, {icon: 2});
                        }
                    }
                });
            },function(){
                //取消
            })}
    </script>
@endsection
