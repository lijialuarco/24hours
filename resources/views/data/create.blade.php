@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2">

        </div>


        <form class="col-md-8" method="post" action="/data" enctype="multipart/form-data">
            @if($errors->has('excel'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ $errors->first('excel') }}
                </div>
            @endif
            {{ csrf_field() }}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="year">入学年份</label>
                    <input type="text" name="year" class="form-control" id="year"
                           placeholder="">
                </div>
                <div class="form-group col-md-6">
                    <label for="name">业主姓名</label>
                    <input type="text" name="name" class="form-control" id="name"
                           placeholder="">
                </div>
            </div>

            <div class="form-group">
                <label for="community_name">小区名称</label>
                <input type="text" name="community_name" class="form-control" id="community_name"
                       placeholder="">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="house_no">房间号</label>
                    <input type="text" class="form-control" id="house_no"
                           name="house_no"
                           placeholder="">
                </div>
                <div class="form-group col-md-6">
                    <label for="remarks">备注</label>
                    <input type="text" name="remarks" class="form-control" id="remarks"
                           placeholder="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-11">
                </div>
                <button type="submit" class="btn btn-primary">添加</button>
            </div>

        </form>
    </div>
@endsection