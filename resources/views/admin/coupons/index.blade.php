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

                    <li class="breadcrumb-item"><a href="">@lang('admin.coupons')</a>
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
                    <h4 class="card-title"> @lang('admin.coupons')</h4>
                    @if(Auth::guard('admin')->user()->hasPermission('coupons-create'))
                    <button class="dt-button create-new btn btn-dark d-inline-flex" type="button" data-toggle="modal"
                        data-target="#modal-add-coupon">
                        <span style="font-size: 15px;">+ @lang('admin.addcoupons')</span>
                    </button>
                    @else
                    <button class="dt-button create-new btn btn-dark d-inline-flex disabled" type="button">
                        <span style="font-size: 15px;">+ @lang('admin.addcoupons')</span>
                    </button>
                    @endif

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered coupon-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    @if(Auth::guard('admin')->user()->hasPermission('coupons-create'))
    <div class="modal modal-slide-in fade" id="modal-add-coupon">
        <div class="modal-dialog sidebar-sm">
            <form id="addcoupon" method="POST" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addcoupons')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                        <div class="form-group">
                            <label class="form-label">@lang('admin.voucher')</label>
                            <input type="text" name="code" value="{{old('code')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.voucher')" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('admin.from')</label>
                            <input type="date" name="from" value="{{old('from')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.from')" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('admin.to')</label>
                            <input type="date" name="to" value="{{old('to')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.to')" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('admin.precent')</label>
                            <input type="number" name="precent" value="{{old('precent')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.precent')" class="form-control" required/>
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
    @if(Auth::guard('admin')->user()->hasPermission('coupons-update'))
    <div class="modal modal-slide-in fade" id="modal-edit-coupon">
        <div class="modal-dialog sidebar-sm">
            <form id="editcoupon" method="post" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
               @csrf
               @method('put')
               <input type="hidden" name="couponId" id="Coupon_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editcoupons')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <label class="form-label">@lang('admin.voucher')</label>
                        <input type="text" name="code" id="code" parsley-trigger="change" 
                        placeholder="@lang('admin.voucher')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.from')</label>
                        <input type="date" name="from" id="from" parsley-trigger="change" 
                        placeholder="@lang('admin.from')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.to')</label>
                        <input type="date" name="to" id="to" parsley-trigger="change" 
                        placeholder="@lang('admin.to')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.precent')</label>
                        <input type="number" name="precent" id="precent" parsley-trigger="change" 
                        placeholder="@lang('admin.precent')" class="form-control" required/>
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

        $('body').on('submit','#addcoupon',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('coupons.store') }}',
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
                    $('.coupon-table').DataTable().ajax.reload();
                    $modal = $('#modal-add-coupon');
                    $modal.find('form')[0].reset();
                    $('#modal-add-coupon').modal('hide');
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
            var coupon_id = $(this).data('id');
            $.ajax({
                url:'{{ route('couponactive') }}',
                type:'GET',
                data:{
                    'active': active,
                    'coupon_id': coupon_id
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
            var id = $(this).data('couponid');
            var code = $(this).data('code');
            var from = $(this).data('from');
            var to = $(this).data('to');
            var precent = $(this).data('precent');

            $('#Coupon_id').val(id);
            $('#code').val(code);
            $('#from').val(from);
            $('#to').val(to);
            $('#precent').val(precent);
        })

      $('body').on('submit','#editcoupon',function (e) {
                e.preventDefault();
                let id = $('#Coupon_id').val();
                var url = '{{ route('coupons.update', ':id') }}';
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
                    $('.coupon-table').DataTable().ajax.reload();
                    $modal = $('#modal-edit-coupon');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-coupon').modal('hide');
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
                $('.coupon-table').DataTable().ajax.reload();
             }
           });
        })
    
</script>
@endpush
