@extends('layouts.app')
@section('css')
    <style>
        #customFile .custom-file-control:lang(en)::after {
            content: "Select file...";
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @if($errors->has('excel'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                {{ $errors->first('excel') }}
            </div>
        @endif
        <div class="row clearfix">
            <div class="col-md-12 column">
                <p class="text-primary">本页面提供excel上传</p>
            </div>

            <form method="post" action="{{ route('init') }}" class="col-md-12 column" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" name="excel"
                               class="custom-file-input" id="excel">
                        <label
                                class="custom-file-label"
                               for="excel">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <button class="input-group-text" id="" type="submit">Upload</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection

@section('js')
    <script>

        /* show file value after file select */
        $('.custom-file-input').on('change', function () {
            $(this).next('.form-control-file').addClass("selected").html($(this).val());
        })

        /* method 2 - change file input to text input after selection
         $('.custom-file-input').on('change',function(){
         var fileName = $(this).val();
         $(this).next('.form-control-file').hide();
         $(this).toggleClass('form-control custom-file-input').attr('type','text').val(fileName);
         })
         */
    </script>
@endsection