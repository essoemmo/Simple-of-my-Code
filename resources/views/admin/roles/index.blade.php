
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

                    <li class="breadcrumb-item"><a href="">@lang('admin.roles')</a>
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
                    <h4 class="card-title"> @lang('admin.roles')</h4>
                    @if(Auth::guard('admin')->user()->hasPermission('roles-create'))
                    <button class="dt-button create-new btn btn-dark d-inline-flex" type="button" data-toggle="modal"
                        data-target="#modal-add-role">
                        <span style="font-size: 15px;">+ @lang('admin.addroles')</span>
                    </button>
                    @else
                    <button class="dt-button create-new btn btn-dark d-inline-flex disabled" type="button">
                        <span style="font-size: 15px;">+ @lang('admin.addroles')</span>
                    </button>
                    @endif

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered role-table'
                    ],true) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    @if(Auth::guard('admin')->user()->hasPermission('roles-create'))
    <div class="modal modal-slide-in fade" id="modal-add-role">
        <div class="modal-dialog sidebar-sm" style="width: 45%">
            <form id="addrole" method="POST" class="add-new-record modal-content pt-0" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addroles')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <label class="form-label">@lang('admin.namerole')</label>
                        <input type="text" name="name" value="{{old('name')}}" required
                            parsley-trigger="change" placeholder="@lang('admin.namerole')"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>@lang('admin.model')</th>
                                <th>@lang('admin.permissions')</th>
                            </tr>
                            @foreach($models as $index=>$model)
                            @if($model == 'settings' || $model == 'aboutus' || $model == 'terms' || $model == 'privacy' || $model == 'usages' || $model == 'sections')
                            <?php $actions = ['read','update']; ?>
                            @endif
                            @if($model == 'rates')
                            <?php $actions = ['read','update','delete']; ?>
                            @endif
                            @if($model == 'contactus')
                            <?php $actions = ['read','delete']; ?>
                            @endif
                                <tr>
                                    <td style="width:5%">{{$index+1}}</td>
                                    <td style="width:5%">@lang('admin.'.$model)</td>
                                    <td>
                                        <select class="select2 form-control" name="permissions[]" multiple = "multiple">
                                            @foreach($actions as $index=>$action)
                                                <option value="{{$model.'-'.$action}}">@lang('admin.'.$action)</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <button type="submit" name="submit"
                        class="btn btn-dark data-submit mr-1">@lang('admin.save')</button>
                    <button type="reset" class="btn btn-outline-secondary"
                        data-dismiss="modal">@lang('admin.cancel')</button>
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

    $('body').on('submit','#addrole',function (e) {
            e.preventDefault();
            
            $.ajax({
                url: '{{ route('roles.store') }}',
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
                        // "rtl": isRtl 
                    }
                    toastr['success']("@lang('admin.added')");
                }
                $('.role-table').DataTable().ajax.reload();
                    $modal = $('#modal-add-role');
                    $modal.find('form')[0].reset();
                    $('#modal-add-role').modal('hide');
                },
                error: function (response) {
                     var errors = response.responseJSON.errors;
                     $.each(errors, function( index, value ) {
                    toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true,
                        "showDuration": 500, 
                        // "rtl": isRtl 
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
                $('.role-table').DataTable().ajax.reload();
             }
           });
        })
    
   </script>   

@endpush
