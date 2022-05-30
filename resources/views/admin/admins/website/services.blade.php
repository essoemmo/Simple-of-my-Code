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
                        <h4 class="card-title">@lang('admin.services')</h4>
                    </div>
                    <form method="POST" id="aboutUs" enctype="multipart/form-data" data-parsley-validate>
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                @foreach(config('translatable.locales') as $lang)
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="basicInput">@lang('admin.'.$lang.'.title')</label>
                                            <input type="text" class="form-control" name="{{$lang}}[title]" value="{{$service->translate($lang)->title}}" required parsley-trigger="change" placeholder="@lang('admin.title')" />
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('admin.'.$lang.'.description')</label>
                                            <textarea name="{{$lang}}[description]" rows="5" class="form-control" >{{ $service->translate($lang)->description }}</textarea>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="customFile">@lang('admin.photo')</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input image" name="url" id="image" />
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        @if($service->websiteImages()->first())
                                            <img src="{{$service->websiteImages()->first()->image_path}}" width="200" height="100" class="image-show img-thumbnail img-rounded" style="margin-right: 130px;"/>
                                        @else
                                            <img src="{{asset('/website/img/mob.png')}}" width="200" height="100" class="image-show img-thumbnail img-rounded" style="margin-right: 130px;"/>
                                        @endif
                                    </div>
                                </div>

                                {{--                             About Us Items Inputs                                       --}}
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <lable>@lang('admin.items')</lable>
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                @foreach ($serviceItems as  $index => $item)
                                                    <li class="nav-item"><a class="nav-link {{ $index==0? 'active':'' }}" href="#item{{ $item->id }}" data-toggle="tab">@lang('admin.item')</a></li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content">
                                                @forelse($serviceItems as  $index => $item)
                                                    <div class="tab-pane {{ $index==0? 'active':'' }}" id="item{{$item->id}}">
                                                        @foreach(config('translatable.locales') as $lang)

                                                            <div class="col-xl-6 col-md-6 col-12 mb-1 border-top">
                                                                <div class="form-group">
                                                                    <label for="basicInput">@lang('admin.'.$lang.'.title')</label>
                                                                    <input type="text" class="form-control" name="items[{{$item->id}}][{{$lang}}][title]" value="{{$item->translate($lang)->title}}" required parsley-trigger="change" placeholder="@lang('admin.title')" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>@lang('admin.'.$lang.'.description')</label>
                                                                    <textarea name="items[{{$item->id}}][{{$lang}}][description]" rows="5" class="form-control" >{{ $item->translate($lang)->description }}</textarea>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label for="customFile">@lang('admin.photo')</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input item-image" name="items[{{$item->id}}][url]" id="image" />
                                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                @if($item->websiteImages()->first())
                                                                    <img src="{{$item->websiteImages()->first()->image_path}}" width="200" height="100" class="item-image-show img-thumbnail img-rounded" style="margin-right: 130px;"/>
                                                                @else
                                                                    <img src="{{asset('/website/img/mob.png')}}" width="200" height="100" class="item-image-show img-thumbnail img-rounded" style="margin-right: 130px;"/>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                {{--                                    <div class="form-group col-xl-12 col-md-12 col-12">--}}
                                <button type="submit" name="submit"
                                        class="btn btn-primary data-submit mr-1">@lang('admin.save')</button>
                                <button type="reset" class="btn btn-outline-secondary">@lang('admin.cancel')</button>
                                {{--                                    </div>--}}

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
            $('body').on('submit','#aboutUs',function (e) {
                e.preventDefault();
                var lang = ('{{app()->getLocale()}}'== 'ar' ? true : false );
                $.ajax({
                    url: '{{ route('services.update', $service->id)}}',
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
                                "showDuration": 300,
                                "rtl": lang

                            }
                            toastr['success']("@lang('admin.updatesuccessfully')");
                        }
                    },

                    error: function (response) {
                        var errors = response.responseJSON.errors;
                        $.each(errors, function( index, value ) {
                            toastr.options =
                                {
                                    "closeButton" : true,
                                    "progressBar" : true,
                                    "showDuration": 500,
                                    "rtl": lang
                                }
                            toastr['error'](value);
                        });
                    }

                });
            });

        });
    </script>

@endpush
