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

                    <li class="breadcrumb-item"><a href="">@lang('admin.aboutus')</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

 {{-- main section crud in one page --}}
 <section id="input-group-basic">
    <div class="row">
        <!-- Basic -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.aboutus')</h4>
                </div>
                <div class="card-body">
                    <form id="editabout" method="POST" class="add-new-record pt-0" data-parsley-validate>
                        @csrf
                        @method('put')
                    <div class="row">
             
                        <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@lang('admin.ar.description')</span>
                        </div>
                        <textarea class="form-control" name="description_ar" cols="10" rows="15" aria-label="With textarea">{!! $about->description_ar !!}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@lang('admin.en.description')</span>
                        </div>
                        <textarea class="form-control" name="description_en" cols="10" rows="15" aria-label="With textarea">{!! $about->description_en !!}</textarea>
                    </div>
                </div>
            </div>
                 <div class="col-md-6 mt-3 mb-3" style="margin-left: 25%;">
            <button type="submit" name="submit" class="btn btn-dark btn-block">@lang('admin.update')</button>
                </div>
        </form>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('js')

<script>

        $('body').on('submit','#editabout',function (e) {
                e.preventDefault();
                let id = $('#About_id').val();
                var url = '{{ route('aboutus.update', ':id') }}';
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
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
</script>   

@endpush
