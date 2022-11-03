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

                    <li class="breadcrumb-item"><a href="">@lang('admin.orders')</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<h3 class="content-header-title" style="text-align: center;margin-bottom: 7px;margin-top: 20px;"> @lang('admin.totalorder') :: {{$seller->sellerOrders->sum('total')}}</h3>

 {{-- main section crud in one page --}}
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered order-table'
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
@endpush