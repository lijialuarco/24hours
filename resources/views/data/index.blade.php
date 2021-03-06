@extends('layouts.app')
@section('css')
    <style>
        /*.table-input {*/
        /*display: none;*/
        /*}*/

        /*.table-span {*/
        /*cursor: pointer;*/
        /*}*/

    </style>

@endsection

@section('content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <form method="get" action="/data" class="col-md-12 column">
                    <div class="input-group">
                        <input type="text" name="year" class="form-control" placeholder="入学年份"
                               value="{{ request('year')  }}">
                        <input type="text" name="name" class="form-control" placeholder="业主姓名"
                               value="{{ request('name')  }}">
                        <input type="text" name="house_no" class="form-control" placeholder="房号"
                               value="{{ request('house_no')  }}">
                        <input type="text" name="community_name" class="form-control" placeholder="小区名称"
                               value="{{ request('community_name')  }}">
                        <button type="submit" class="btn btn-default">搜索</button>
                        <a href="/data-export"
                           class="btn btn-xs btn-edit">导出</a>
                    </div>
                </form>
            </div>


            <div class="col-md-12 column">
                <table class="table  table-hover">
                    <thead>
                    <tr>
                        <th>
                            入学时间
                        </th>
                        <th>
                            业户姓名
                        </th>
                        <th>
                            房号
                        </th>
                        <th>
                            小区名称
                        </th>
                        <th>
                            备注
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr data-url="/data/{{ $item->id }}/edit">
                            <td style="width: 10%">
                                {{--<input type="text" class="form-control table-input" id="exampleInputEmail1"--}}
                                {{--value="{{ $item->year }}">--}}
                                <div class="table-span">{{ $item->year }} </div>
                            </td>
                            <td style="width: 15%">
                                {{--<input type="text" class="form-control table-input" id="exampleInputEmail1"--}}
                                {{--value="{{ $item->name }}">--}}
                                <div class="table-span">{{ $item->name }} </div>
                            </td>
                            <td style="width: 15%">
                                {{--<input type="text" class="form-control table-input" id="exampleInputEmail1"--}}
                                {{--value="{{ $item->house_no }}">--}}
                                <div class="table-span">{{ $item->house_no }} </div>
                            </td>
                            <td style="width:35%">
                                {{--<input type="text" class="form-control table-input" id="exampleInputEmail1"--}}
                                {{--value="{{ $item->community_name }}">--}}
                                <div class="table-span">{{ $item->community_name }} </div>
                            </td>
                            <td style="width: 20%">
                                {{--<input type="text" class="form-control table-input" id="exampleInputEmail1"--}}
                                {{--value="{{ $item->remarks }}">--}}
                                <div class="table-span">{{ $item->remarks }} </div>
                            </td>
                            <td style="width: 5%">
                                {{--<input type="text" class="form-control table-input" id="exampleInputEmail1"--}}
                                {{--value="{{ $item->remarks }}">--}}
                                <button class="btn-sm btn-outline-warning btn-delete"
                                        data-url="/data/{{$item->id}}">删除
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr data-url="/data/create">
                        <td colspan="6" align="center">
                            <button type="button" class="btn btn-info">添加</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <nav class="text-xs-center" style="text-align: center">
                    {{ $data->links() }}
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('tr').on('click', function () {
                var url = $(this).attr("data-url");
                console.log(url);
                location.href = url;
            });
        });


        $(function () {
            // delegate deletion event
            $('.btn-delete').on('click', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $this = $(this);
                $.ajax({
                        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                        url: $this.data('url'),
                        type: 'delete'
                    })
                    .done(function (resp) {
                        console.log("delete success");

                        // remove row
                        //$tr.remove();

                        // instead of removing row, refresh the page
                        location.reload();

                    })

            });
        });


        //        console.log($('.table-span'));
        //        $(function () {
        //            $('.table-span').each(function (i) {
        //                console.log(i);
        //
        //                $(this).on('click', function () {
        ////                    $()
        //                    $(this).hide().siblings('input').css('display', 'block').parent().siblings().find('input').css('display', 'none');
        //                    $(this).parent().siblings().find('.table-span').css('display', 'block');
        //                    $(this).parents('tr').siblings().find('input').css('display', 'none');
        //                    $(this).parents('tr').siblings().find('.table-span').css('display', 'block');
        //                });
        //            });
        //        });
        //
        //
        //        $(function () {
        //            $('.edit-btn').each(function (i) {
        //                console.log(i);
        //
        //                $(this).on('click', function () {
        ////                    $()
        //                    var data = {
        //                        year:
        //                    }
        //                    var id = $(this).parent().attr('id')
        //                });
        //            });
        //        });
        //        $(function () {
        //            $('.table-span').on('click', function () {
        //                console.log($('.table-span').eq());
        //                console.log('hi');
        //            })

        //        var span = document.getElementsByClassName('table-span')[0];
        //        console.log(span);
        //        span.onclick = function () {
        //            console.log('span')
        //        }

    </script>
@endsection
