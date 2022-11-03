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

                    <li class="breadcrumb-item"><a href="">@lang('admin.languages')</a>
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
                    <h4 class="card-title"> @lang('admin.languages')</h4>
                    @if(Auth::guard('admin')->user()->hasPermission('languages-create'))
                    <button class="dt-button create-new btn btn-gradient-success d-inline-flex" type="button" data-toggle="modal"
                        data-target="#modal-add-language">
                        <span style="font-size: 15px;">+ @lang('admin.addlanguages')</span>
                    </button>
                    @else
                    <button class="dt-button create-new btn btn-gradient-success d-inline-flex disabled" type="button">
                        <span style="font-size: 15px;">+ @lang('admin.addlanguages')</span>
                    </button>
                    @endif

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered language-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    @if(Auth::guard('admin')->user()->hasPermission('languages-create'))
    <div class="modal modal-slide-in fade" id="modal-add-language">
        <div class="modal-dialog sidebar-sm">
            <form id="addlanguage" method="POST" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addlanguages')</h5>
                </div>
                <div class="modal-body flex-grow-1">

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


                        <div class="row" style="margin-top: 15px;">
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
    @if(Auth::guard('admin')->user()->hasPermission('languages-update'))
    <div class="modal modal-slide-in fade" id="modal-edit-language">
        <div class="modal-dialog sidebar-sm">
            <form id="editlanguage" method="post" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
               @csrf
               @method('put')

               <input type="hidden" name="languageId" id="Language_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editlanguages')</h5>
                </div>
                <div class="modal-body flex-grow-1">

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


                    <div class="row" style="margin-top: 15px;">
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

        $('body').on('submit','#addlanguage',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('languages.store') }}',
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
                    $('.language-table').DataTable().ajax.reload();
                    $modal = $('#modal-add-language');
                    $modal.find('form')[0].reset();
                    $('#modal-add-language').modal('hide');
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
            var id = $(this).data('languageid');
            var title_ar = $(this).data('title_ar');
            var title_en = $(this).data('title_en');

            $('#Language_id').val(id);
            $('#title_ar').val(title_ar);
            $('#title_en').val(title_en);
        })

      $('body').on('submit','#editlanguage',function (e) {
                e.preventDefault();
                let id = $('#Language_id').val();
                var url = '{{ route('languages.update', ':id') }}';
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
                    $('.language-table').DataTable().ajax.reload();
                    $modal = $('#modal-edit-language');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-language').modal('hide');
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
                $('.language-table').DataTable().ajax.reload();
             }
           });
        })
    
</script>
@endpush
