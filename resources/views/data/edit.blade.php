@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2">

        </div>


        <form class="col-md-8" method="post" action="/data/{{$data->id}}" enctype="multipart/form-data">
            @if($errors->has('excel'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ $errors->first('excel') }}
                </div>
            @endif
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="year">入学年份</label>
                    <input type="text" name="year" class="form-control" id="year"
                           value="{{ $data->year }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="name">业主姓名</label>
                    <input type="text" name="name" class="form-control" id="name"
                           value="{{ $data->name }}">
                </div>
            </div>

            <div class="form-group">
                <label for="community_name">小区名称</label>
                <input type="text" name="community_name" class="form-control" id="community_name"
                       value="{{ $data->community_name }}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="house_no">房间号</label>
                    <input type="text" class="form-control" id="house_no"
                           name="house_no"
                           value="{{ $data->house_no }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="remarks">备注</label>
                    <input type="text" name="remarks" class="form-control" id="remarks"
                           value="{{ $data->remarks }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-11">
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </div>

        </form>
    </div>
@endsection