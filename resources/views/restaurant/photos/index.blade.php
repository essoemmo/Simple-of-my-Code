@extends('restaurant.layout.master')
@section('content')
@push('css')
<style>
    .box {
       position: relative;
    }
    .box .btn {
       position: absolute;
       top: 100%;
       left: 50%;
       transform: translate(-50%, -50%);
    }
 </style>
@endpush
<section id="card-content-types">
    <h5 class="mt-3">@lang('admin.photo')</h5>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <form id="addphoto" method="POST" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                @method('post')
                <div class="input-group">
                    <input type="file" name="image" class="form-control image" placeholder="Button on right" aria-describedby="button-addon2" />
                    <div class="input-group-append" id="button-addon2">
                        <button type="submit" name="submit" class="btn btn-dark data-submit mr-1">@lang('admin.save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row mt-4"  id="photoDiv">
@foreach ($photos as $photo )
    <div class="col-md-6 col-lg-4">
            <div class="card mb-4 box">
                <img class="card-img-top" src="{{getImagePath($photo->image)}}" alt="Card image cap" style="height: 260px;"/>
                <form class="delete"  action= "{{route('photos.destroy', $photo->id)}}"  method="POST" id="delform"
                    style="display: inline-block; right: 50px;" >
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="_token" value={{csrf_token()}}>
                    <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger"><i data-feather="trash-2"></i></button>
                </form>
            </div>
    </div>
@endforeach
        

    </div>
</section>
@endsection

@push('js')

<script>

    $('body').on('submit','#addphoto',function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('photos.store') }}',
            method: "post",
            data: new FormData(this),
            dataType: 'json',
            cache       : false,
            contentType : false,
            processData : false,
            success: function (response) {
            if(response.status == 'success'){
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true,
                    "showDuration": 500, 
                }
                toastr['success']("@lang('admin.added')");
            }
            window.location.reload();

            },
            error: function (response) {
                var errors = response.responseJSON.errors;
                $.each(errors, function( index, value ) {
                toastr.options ={
                        "closeButton" : true,
                        "progressBar" : true,
                        "showDuration": 500, 
                    }
                toastr['error'](value);
                });
            }


        });
  });

  $('body').on('submit','#delform',function (e) {
           e.preventDefault();
           var url = $(this).attr('action');
           $.ajax({
             url: url,
             method: "delete",
             data: {
                 _token: '{{ csrf_token() }}',
             },
             success: function (response) {
                window.location.reload();
             }
           });
        })

  </script>
@endpush