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

                    <li class="breadcrumb-item"><a href="">@lang('admin.contactus')</a>
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
                    <h4 class="card-title"> @lang('admin.contactus')</h4>
                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered contactus-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    @if(Auth::guard('admin')->user()->hasPermission('contactus-read'))
    <div class="modal fade text-left modal-show-contactus" id="modal-show-contactus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content" id="subject">
               
           </div>
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
 
     $('body').on('click','.contact',function () {
        var contact_id = $(this).data('id');
        $.ajax({
            url:'{{ route('contactusdetails') }}',
            type:'GET',
            data:{
                'contact_id': contact_id
            },
            success: function (response) {
                    var docRow = '';
                    $('#subject').html('');
                    $.each(response, function(index, value){
                      docRow = '<div class="modal-header">'+value.phone+'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">'+value.description+'</div>';

                    $('#subject').append(docRow);

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
                $('.contactus-table').DataTable().ajax.reload();
             }
           });
        })

</script>   

@endpush
