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

                    <li class="breadcrumb-item"><a href="">@lang('admin.types')</a>
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
                    <h4 class="card-title"> @lang('admin.types')</h4>
                    <button class="dt-button create-new btn btn-dark d-inline-flex" type="button" data-toggle="modal"
                        data-target="#modal-add-type">
                        <span style="font-size: 15px;">+ @lang('admin.addtypes')</span>
                    </button>
                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered type-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modal-add-type">
        <div class="modal-dialog sidebar-sm">
            <form id="addtype" method="POST" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addtypes')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <input type="hidden" name="product_id" value="{{$product->id}}">

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
                        <label class="form-label">@lang('admin.price')</label>
                        <input type="text" name="price" value="{{old('price')}}" parsley-trigger="change" 
                        placeholder="@lang('admin.price')" class="form-control"/>
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

    <div class="modal modal-slide-in fade" id="modal-edit-type">
        <div class="modal-dialog sidebar-sm">
            <form id="edittype" method="post" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
               @csrf
               @method('put')
               <input type="hidden" name="typeId" id="Type_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.edittypes')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                     <div class="form-group">
                        <label class="form-label">@lang('admin.ar.title')</label>
                        <input type="text" id="title_ar" name="title_ar" value="{{old('title_ar')}}" parsley-trigger="change" 
                        placeholder="@lang('admin.title_ar')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.title')</label>
                        <input type="text" id="title_en" name="title_en" value="{{old('title_en')}}" parsley-trigger="change" 
                        placeholder="@lang('admin.title_en')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.price')</label>
                        <input type="text" name="price" id="Price" parsley-trigger="change" 
                        placeholder="@lang('admin.price')" class="form-control"/>
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

        $('body').on('submit','#addtype',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('types.store') }}',
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
                    $('.type-table').DataTable().ajax.reload();
                    $modal = $('#modal-add-type');
                    $modal.find('form')[0].reset();
                    $('#modal-add-type').modal('hide');
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

      $('body').on('click','.edit',function (e) {

            e.preventDefault();
            var id = $(this).data('typeid');
            var title_ar = $(this).data('title_ar');
            var title_en = $(this).data('title_en');
            var price = $(this).data('price');

            $('#Type_id').val(id);
            $('#title_ar').val(title_ar);
            $('#title_en').val(title_en);
            $('#Price').val(price);
        })

      $('body').on('submit','#edittype',function (e) {
                e.preventDefault();
                let id = $('#Type_id').val();
                var url = '{{ route('types.update', ':id') }}';
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
                    $('.type-table').DataTable().ajax.reload();
                    $modal = $('#modal-edit-type');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-type').modal('hide');
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
                $('.type-table').DataTable().ajax.reload();
             }
           });
        })
    
</script>
@endpush
