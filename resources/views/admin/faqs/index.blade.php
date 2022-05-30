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

                    <li class="breadcrumb-item"><a href="">@lang('admin.faqs')</a>
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
                    <h4 class="card-title"> @lang('admin.faqs')</h4>
                    @if(Auth::guard('admin')->user()->hasPermission('faqs-create'))
                    <button class="dt-button create-new btn btn-dark d-inline-flex" type="button" data-toggle="modal"
                        data-target="#modal-add-faq">
                        <span style="font-size: 15px;">+ @lang('admin.addfaqs')</span>
                    </button>
                    @else
                    <button class="dt-button create-new btn btn-dark d-inline-flex disabled" type="button">
                        <span style="font-size: 15px;">+ @lang('admin.addfaqs')</span>
                    </button>
                    @endif

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered faq-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    @if(Auth::guard('admin')->user()->hasPermission('faqs-create'))
    <div class="modal modal-slide-in fade" id="modal-add-faq">
        <div class="modal-dialog sidebar-sm">
            <form id="addfaq" method="POST" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addfaqs')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                        <div class="form-group">
                            <label class="form-label">@lang('admin.ar.question')</label>
                            <input type="text" name="question_ar" value="{{old('question_ar')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.question_ar')" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('admin.en.question')</label>
                            <input type="text" name="question_en" value="{{old('question_en')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.question_en')" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('admin.ar.answer')</label>
                            <textarea class="form-control" name="answer_ar" cols="10" rows="10"></textarea>
                        </div>
    
                        <div class="form-group">
                            <label class="form-label">@lang('admin.en.answer')</label>
                            <textarea class="form-control" name="answer_en" cols="10" rows="10"></textarea>
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
    @if(Auth::guard('admin')->user()->hasPermission('faqs-update'))
    <div class="modal modal-slide-in fade" id="modal-edit-faq">
        <div class="modal-dialog sidebar-sm">
            <form id="editfaq" method="post" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
               @csrf
               @method('put')
               <input type="hidden" name="faqId" id="Faq_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editfaqs')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.question')</label>
                        <input type="text" name="question_ar" id="question_ar" parsley-trigger="change" 
                        placeholder="@lang('admin.question_ar')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.question')</label>
                        <input type="text" name="question_en" id="question_en" parsley-trigger="change" 
                        placeholder="@lang('admin.question_en')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.answer')</label>
                        <textarea class="form-control" name="answer_ar" id="answer_ar" cols="10" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.answer')</label>
                        <textarea class="form-control" name="answer_en" id="answer_en" cols="10" rows="10"></textarea>
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

        $('body').on('submit','#addfaq',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('faqs.store') }}',
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
                    $('.faq-table').DataTable().ajax.reload();
                    $modal = $('#modal-add-faq');
                    $modal.find('form')[0].reset();
                    $('#modal-add-faq').modal('hide');
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
            var id = $(this).data('faqid');
            var question_ar = $(this).data('question_ar');
            var question_en = $(this).data('question_en');
            var answer_ar = $(this).data('answer_ar');
            var answer_en = $(this).data('answer_en');

            $('#Faq_id').val(id);
            $('#question_ar').val(question_ar);
            $('#question_en').val(question_en);
            $('#answer_ar').val(answer_ar);
            $('#answer_en').val(answer_en);
        })

      $('body').on('submit','#editfaq',function (e) {
                e.preventDefault();
                let id = $('#Faq_id').val();
                var url = '{{ route('faqs.update', ':id') }}';
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
                    $('.faq-table').DataTable().ajax.reload();
                    $modal = $('#modal-edit-faq');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-faq').modal('hide');
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
                $('.faq-table').DataTable().ajax.reload();
             }
           });
        })
    
</script>
@endpush
