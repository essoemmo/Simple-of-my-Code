@extends('restaurant.layout.master')
@section('content')

<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">@lang('admin.dashboard')</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">@lang('admin.home')</a>
                    </li>

                    <li class="breadcrumb-item"><a href="">@lang('admin.products')</a>
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
                    <h4 class="card-title"> @lang('admin.products')</h4>
                    <button class="dt-button create-new btn btn-dark d-inline-flex add" type="button" data-toggle="modal"
                        data-target="#modal-add-product">
                        <span style="font-size: 15px;">+ @lang('admin.addproducts')</span>
                    </button>
                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered product-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modal-add-product">
        <div class="modal-dialog sidebar-sm">
            <form id="addproduct" method="POST" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addproducts')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <img src="" width="130" height="130" alt="" style="margin-left: 75px; border-radius: 60px;" class="image-show img-circle"/>
                    </div>

                    <div class="form-group">
                        <label for="customFile">@lang('admin.productimage')</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input image" name="image" id="image" />
                            <label class="custom-file-label" for="customFile">@lang('admin.productimage')</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.title')</label>
                        <input type="text" name="title_ar" value="{{old('title_ar')}}" parsley-trigger="change" 
                        placeholder="@lang('admin.ar.title')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.title')</label>
                        <input type="text" name="title_en" value="{{old('title_en')}}" parsley-trigger="change" 
                        placeholder="@lang('admin.en.title')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label>@lang('admin.category')</label>
                        <select class="select2 form-control" name="category_id">
                            <option value="">---</option>
                            @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{$category->title}}</option>
                            @endforeach
                        </select>
                    </div> 

                    <div class="form-group">
                        <label class="form-label">@lang('admin.price')</label>
                        <input type="text" name="main_price" value="{{old('main_price')}}" parsley-trigger="change" 
                        placeholder="@lang('admin.price')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.short_desc')</label>
                        <textarea class="form-control" name="short_desc_ar" cols="10" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.short_desc')</label>
                        <textarea class="form-control" name="short_desc_en" cols="10" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.description')</label>
                        <textarea class="form-control" name="description_ar" cols="10" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.description')</label>
                        <textarea class="form-control" name="description_en" cols="10" rows="10"></textarea>
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

    <div class="modal modal-slide-in fade" id="modal-edit-product">
        <div class="modal-dialog sidebar-sm">
            <form id="editproduct" method="post" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
               @csrf
               @method('put')
               <input type="hidden" name="productId" id="Product_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editproducts')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <img src="" width="130" height="130" alt="" style="margin-left: 75px; border-radius: 60px;" class="image-show img-circle"/>
                    </div>

                    <div class="form-group">
                        <label for="customFile">@lang('admin.productimage')</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input image" name="image" id="image" />
                            <label class="custom-file-label" for="customFile">@lang('admin.productimage')</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.title')</label>
                        <input type="text" name="title_ar" id="title_ar" parsley-trigger="change" 
                        placeholder="@lang('admin.ar.title')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.title')</label>
                        <input type="text" name="title_en" id="title_en" parsley-trigger="change" 
                        placeholder="@lang('admin.en.title')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label>@lang('admin.category')</label>
                        <select class="select2 form-control" name="category_id" id="catMain">
                            <option value="">---</option>
                            @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{$category->title}}</option>
                            @endforeach
                        </select>
                    </div> 

                    <div class="form-group">
                        <label class="form-label">@lang('admin.price')</label>
                        <input type="text" name="main_price" id="Mainprice" parsley-trigger="change" 
                        placeholder="@lang('admin.price')" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.short_desc')</label>
                        <textarea class="form-control" name="short_desc_ar" id="short_desc_ar" cols="10" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.short_desc')</label>
                        <textarea class="form-control" name="short_desc_en" id="short_desc_en" cols="10" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.description')</label>
                        <textarea class="form-control" name="description_ar" id="description_ar" cols="10" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.description')</label>
                        <textarea class="form-control" name="description_en" id="description_en" cols="10" rows="10"></textarea>
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
    
    <div class="modal fade text-left" id="typesList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Types</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body" id="ShowTypes">

                    </div>
            </div>
        </div>
    </div>

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
        $('body').on('submit','#addproduct',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('products.store') }}',
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
                    $('.product-table').DataTable().ajax.reload();
                    $modal = $('#modal-add-product');
                    $modal.find('form')[0].reset();
                    $('#modal-add-product').modal('hide');
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

      $('body').on('click','.types',function () {
        //   alert('fgdfg');
        var product_id = $(this).data('id');
        $.ajax({
            url:'{{ route('gettypes') }}',
            type:'GET',
            data:{
                'product_id': product_id
            },
            success: function (response) {
                    var docRow = '';
                    $('#ShowTypes').html('');
                    $.each(response, function(index, value){
                      docRow = '<span style="font-size: x-large;">'+value.title+'</span><span style="float: right;font-size: x-large;">'+value.price+'</span><br>';

                    $('#ShowTypes').append(docRow);

                });
            }
        });
    });

      $('body').on('click','#check',function () {
            //e.preventDefault();
            var active = $(this).prop('checked') == true ? 1 : 0; 
            var product_id = $(this).data('id');
            $.ajax({
                url:'{{ route('productactive') }}',
                type:'GET',
                data:{
                    'active': active,
                    'product_id': product_id
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
            var id = $(this).data('productid');
            var title_ar = $(this).data('title_ar');
            var title_en = $(this).data('title_en');
            var short_desc_ar = $(this).data('short_desc_ar');
            var short_desc_en = $(this).data('short_desc_en');
            var description_ar = $(this).data('description_ar');
            var description_en = $(this).data('description_en');
            var main_price = $(this).data('main_price');
            var category = $(this).data('catid');
            var photo = $(this).data('product_image');
            var photo_url = "{{url('')}}/" + photo ;

            $('#Product_id').val(id);
            $('#title_ar').val(title_ar);
            $('#title_en').val(title_en);
            $('#Mainprice').val(main_price);
            $('#short_desc_ar').val(short_desc_ar);
            $('#short_desc_en').val(short_desc_en);
            $('#description_ar').val(description_ar);
            $('#description_en').val(description_en);
            $('#catMain').val(category);
            $('.image-show').attr('src' , photo_url);
            $('.custom-file-label').html('');

        })

      $('body').on('submit','#editproduct',function (e) {
                e.preventDefault();
                let id = $('#Product_id').val();
                var url = '{{ route('products.update', ':id') }}';
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
                    $('.product-table').DataTable().ajax.reload();
                    $modal = $('#modal-edit-product');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-product').modal('hide');
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
                $('.product-table').DataTable().ajax.reload();
             }
           });
        })
    
</script>
@endpush
