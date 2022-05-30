@extends('admin.layout.master')
@section('content')

<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">@lang('admin.dashboard')</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">@lang('admin.home')</a>
                    </li>

                    <li class="breadcrumb-item"><a href="">@lang('admin.settings')</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.updatesetting')</h4>
                </div>
                @foreach($errors->all() as $e)
                    <p>{{$e}}</p>
                @endforeach
                <form method="POST" id="setting" enctype="multipart/form-data" data-parsley-validate>
                    @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-xl-6 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="helpInputTop">@lang('admin.phone')</label>
                                <input type="text" name="phone"  value="{{$setting->phone}}" parsley-trigger="change" required placeholder="@lang('admin.phone')"class="form-control" id="helpInputTop" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="helpInputTop">@lang('admin.address')</label>
                                <input type="text" name="address"  value="{{$setting->address}}" parsley-trigger="change" required placeholder="@lang('admin.address')"class="form-control" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="helpInputTop">@lang('admin.email')</label>
                                <input type="email" name="email"  value="{{$setting->email}}" parsley-trigger="change" required placeholder="@lang('admin.email')"class="form-control" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="helpInputTop">@lang('admin.whatsapp')</label>
                                <input type="text" name="whatsapp"  value="{{$setting->whatsapp}}" parsley-trigger="change" required placeholder="@lang('admin.whatsapp')" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label>@lang('admin.facebook')</label>
                                <input type="text" name="facebook" value="{{$setting->facebook}}" required  parsley-trigger="change" placeholder="@lang('admin.facebook')" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="basicInput">@lang('admin.instagram')</label>
                                <input type="text" name="instagram" value="{{$setting->instagram}}"  parsley-trigger="change" required placeholder="@lang('admin.instagram')" class="form-control" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="basicInput">@lang('admin.twitter')</label>
                                <input type="text" name="twitter" value="{{$setting->twitter}}"  parsley-trigger="change" required placeholder="@lang('admin.twitter')" class="form-control" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="basicInput">@lang('admin.ar.description')</label>
                        <textarea class="form-control" name="description_ar" cols="2" rows="2" aria-label="With textarea">{!! $setting->description_ar !!}</textarea>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="basicInput">@lang('admin.en.description')</label>
                        <textarea class="form-control" name="description_en" cols="2" rows="2" aria-label="With textarea">{!! $setting->description_en !!}</textarea>
                            </div>
                        </div>
               

                        <div class="col-md-6 mt-3 mb-3" style="margin-left: 25%;">
                            <button type="submit" name="submit" class="btn btn-dark btn-block">@lang('admin.update')</button>
                                </div>

                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</section>
@endsection

@push('js')

 <script>
    $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('submit','#setting',function (e) {
                e.preventDefault();
                 //alert('asdasd');
                $.ajax({
                    url: '{{ route('updatesetting')}}',
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,

                    success: function (response) {
                    if(response.status == 'success'){
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true,
                            "showDuration": 500,
                            // "rtl": isRtl
                        }
                        toastr['success']("@lang('admin.updated')");
                    }
                    table.ajax.reload();
                    $modal = $('#modal-edit-city');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-city').modal('hide');
                    },

                    error: function (response) {
                     var errors = response.responseJSON.errors;
                     $.each(errors, function( index, value ) {
                    toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true,
                        "showDuration": 500,
                        // "rtl": isRtl
                    }
                    toastr['error'](value);
                });
                }

                });
            });

        });
 </script>

 @endpush
