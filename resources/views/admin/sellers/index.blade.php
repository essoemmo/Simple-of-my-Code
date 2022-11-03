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

                    <li class="breadcrumb-item"><a href="">@lang('admin.sellers')</a>
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

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered seller-table'
                    ],true) }}

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

$('body').on('click','#check',function () {
    //e.preventDefault();
    var active = $(this).prop('checked') == true ? 1 : 0; 
    var user_id = $(this).data('id');
    $.ajax({
        url:'{{ route('useractive') }}',
        type:'GET',
        data:{
            'active': active,
            'user_id': user_id
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

$('body').on('click','#reset',function () {
    //e.preventDefault();
    var seller_id = $(this).data('seller_id');
    $.ajax({
        url:'{{ route('sellerReset') }}',
        type:'post',
        data:{
            'seller_id': seller_id,
            "_token": "{{ csrf_token() }}",
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
                toastr['success']("@lang('admin.balancerest')");
                $('.seller-table').DataTable().ajax.reload();
            }
        }
    });
});

</script>

@endpush