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

                    <li class="breadcrumb-item"><a href="">@lang('admin.requests')</a>
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
                        'class'=> 'datatables-ajax table table-bordered requests-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>


<div class="modal fade text-left" id="bankList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">@lang('admin.bank_account')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body" id="Showbanks">

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
                $('.requests-table').DataTable().ajax.reload();
            }
        }
    });
});


$('body').on('click','.bank',function () {
        var seller_id = $(this).data('id');
        $.ajax({
            url:'{{ route('bankaccount') }}',
            type:'GET',
            data:{
                'seller_id': seller_id
            },
            success: function (response) {
                    var docRow = '';
                    $('#Showbanks').html('');
                    $.each(response, function(index, value){
                      docRow = '<span style="font-size: x-large;"> @lang('admin.bankname') : '+value.bankName+'</span><br><span style="margin: 5px; font-size: x-large;"> @lang('admin.accountname') : '+value.AccountHolder+'</span><br><span style="margin: 5px; font-size: x-large;"> @lang('admin.accountnumber') : '+value.AccountNumber+'</span><br><span style="margin: 5px; font-size: x-large;"> @lang('admin.iban') : '+value.iban+'</span><br>';

                    $('#Showbanks').append(docRow);

                });
            }
        });
    });

</script>

@endpush