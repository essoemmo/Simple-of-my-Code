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

                    <li class="breadcrumb-item"><a href="">@lang('admin.banners')</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

 {{-- main section crud in one page --}}
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title"> @lang('admin.banners')</h4>
                    @if(Auth::guard('admin')->user()->hasPermission('banners-create'))
                    <button class="dt-button create-new btn btn-dark d-inline-flex" idtype="button" data-toggle="modal"
                        data-target="#modal-add-banner">
                        <span style="font-size: 15px;">+ @lang('admin.addbanners')</span>
                    </button>
                    @else
                    <button class="dt-button create-new btn btn-dark d-inline-flex disabled" type="button">
                        <span style="font-size: 15px;">+ @lang('admin.addbanners')</span>
                    </button>
                    @endif

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered banner-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    @if(Auth::guard('admin')->user()->hasPermission('banners-create'))
    <div class="modal modal-slide-in fade" id="modal-add-banner">
        <div class="modal-dialog sidebar-sm">
            <form id="addbanner" method="POST" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addbanners')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                        <div class="form-group">
                            <img src="" 
                            width="130" height="130" alt="" 
                            style="margin-left: 75px; border-radius: 60px;" 
                            class="image-show img-circle"/>
                         </div>

                        <div class="form-group">
                            <label class="form-label">@lang('admin.ar.title')</label>
                            <input type="text" name="title_ar" value="{{old('title_ar')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.title_ar')" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('admin.en.title')</label>
                            <input type="text" name="title_en" value="{{old('title_en')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.title_en')" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="customFile">@lang('admin.imageprofile')</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input image" name="image" id="image" />
                                <label class="custom-file-label" for="customFile">@lang('admin.imageprofile')</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.restaurants')</label>
                            <select class="select2 form-control" name="restaurant_id">
                                <option value="">---</option>
                                @foreach ($restaurants as $rest)
                            <option value="{{$rest->id}}"> {{$rest->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" name="submit"
                                class="btn btn-dark data-submit mr-1">@lang('admin.save')</button>
                            <button type="reset" class="btn btn-outline-secondary"
                                data-dismiss="modal">@lang('admin.cancel')</button>
                            </div>
                        </div>
                </div>
            </form>
        </div>
    </div>
    @endif

     <!-- Modal to edit record -->
    @if(Auth::guard('admin')->user()->hasPermission('banners-update'))
    <div class="modal modal-slide-in fade" id="modal-edit-banner">
        <div class="modal-dialog sidebar-sm">
            <form id="editbanner" method="post" class="add-new-record modal-content pt-0" data-parsley-validate>
               @csrf
               @method('put')
               <input type="hidden" name="bannerId" id="Banner_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editbanners')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <img src=""
                        width="130" height="130" alt="" 
                        style="margin-left: 75px; border-radius: 60px;" 
                        class="image-show img-circle"/>
                     </div>

                     <div class="form-group">
                        <label class="form-label">@lang('admin.title_ar')</label>
                        <input type="text" id="title_ar" name="title_ar" value="{{old('title_ar')}}" parsley-trigger="change" 
                        placeholder="@lang('admin.title_ar')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.title_en')</label>
                        <input type="text" id="title_en" name="title_en" value="{{old('title_en')}}" parsley-trigger="change" 
                        placeholder="@lang('admin.title_en')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label for="customFile">@lang('admin.imageprofile')</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input image" name="image" id="image" />
                            <label class="custom-file-label" for="customFile">@lang('admin.imageprofile')</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>@lang('admin.restaurants')</label>
                        <select class="select2 form-control" name="rest_id" id="restMain">
                            <option value="">---</option>
                            @foreach ($restaurants as $rest)
                        <option value="{{$rest->id}}"> {{$rest->name}}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="submit"
                            class="btn btn-dark data-submit mr-1">@lang('admin.save')</button>
                        <button type="reset" class="btn btn-outline-secondary"
                            data-dismiss="modal">@lang('admin.cancel')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

</section>

@endsection

@push('js')
<script type="text/javascript">
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            url : '{{asset('AdminS/assets_ar/app-assets/js/scripts/tables/'. app()->getLocale() . '.json') }}'
        }
    });
</script>
{{ $dataTable->scripts() }}

<script>

        $('body').on('submit','#addbanner',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('banners.store') }}',
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
                    $('.banner-table').DataTable().ajax.reload();
                    $modal = $('#modal-add-banner');
                    $modal.find('form')[0].reset();

                    $('#modal-add-banner').modal('hide');
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

      $('body').on('click','#check',function () {
            //e.preventDefault();
            var active = $(this).prop('checked') == true ? 1 : 0; 
            var banner_id = $(this).data('id');
            $.ajax({
                url:'{{ route('banneractive') }}',
                type:'GET',
                data:{
                    'active': active,
                    'banner_id': banner_id
                },
                success: function (response) {
                if (response.status == 'success'){
                        toastr.options =
                        {
                            "closeButton" : true,
                            "progressBar" : true,
                            "showDuration": 500, 
                            // "rtl": isRtl 
                        }
                        toastr['success']("@lang('admin.statuschange')");
                    }
                }
            });
        });

      $('body').on('click','.edit',function (e) {

            e.preventDefault();
            var id = $(this).data('bannerid');
            var title_ar = $(this).data('title_ar');
            var title_en = $(this).data('title_en');
            var rest_id = $(this).data('restid');
            var photo = $(this).data('banner_image');
            var photo_url = "{{url('')}}/" + photo ;

            $('#Banner_id').val(id);
            $('#title_ar').val(title_ar);
            $('#title_en').val(title_en);
            $('#restMain').val(rest_id);
            $('.image-show').attr('src',photo_url);
            $('.custom-file-label').html('');

        })

      $('body').on('submit','#editbanner',function (e) {
                e.preventDefault();
                let id = $('#Banner_id').val();
                var url = '{{ route('banners.update', ':id') }}';
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
                        }
                        toastr['success']("@lang('admin.updated')");
                    }
                    $('.banner-table').DataTable().ajax.reload();
                    $modal = $('#modal-edit-banner');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-banner').modal('hide');
                    },
                    error: function (response) {
                     var errors = response.responseJSON.errors;
                     $.each(errors, function( index, value ) {
                    toastr.options =
                    {
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
                $('.banner-table').DataTable().ajax.reload();
             }
           });
        })
    
</script>
@endpush
