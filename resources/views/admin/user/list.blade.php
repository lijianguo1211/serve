@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>管理员列表</legend>
    </fieldset>
    <div class="table-header">
        <a href="{{url('admin/adduser')}}">
            <i class="menu-icon fa fa-plus orange"></i>
            <span class="menu-text orange"> 添加管理员 </span>
        </a>
        <a href="{{url('admin/cardIndex')}}">
            <i class="menu-icon fa fa-plus orange"></i>
            <span class="menu-text orange"> 实名认证 </span>
        </a>
        <a href="{{url('admin/email')}}">
            <i class="menu-icon fa fa-plus orange"></i>
            <span class="menu-text orange"> 发送邮件 </span>
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
                <th>用户名</th>
                <th>账户id</th>
                <th>昵称</th>
                <th>邮箱</th>
                <th>手机</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user_list as $vo)
            <tr>
                <td>{{$vo->user_id}}</td>
                <td>{{$vo->user_name}}</td>
                <td>{{$vo->user_account}}</td>
                <td>{{$vo->user_nickname}}</td>
                <td>{{$vo->user_email}}</td>
                <td>{{$vo->user_mobile}}</td>
                <td>
                    <div class="hidden-sm hidden-xs action-buttons">
                        <a class="blue" href="{{url('admin/cardIndex',['user_id'=>$vo->user_id])}}">
                            <i class="ace-icon fa fa-user-plus bigger-130"></i>
                        </a>
                        <a class="blue" href="#">
                            <i class="ace-icon fa fa-search-plus bigger-130"></i>
                        </a>
                        <a class="green" href="">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                        </a>

                        <a class="red" href="javascript:void(0);" onclick="">
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