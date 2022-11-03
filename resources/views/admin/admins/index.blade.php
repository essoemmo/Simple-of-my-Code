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

                    <li class="breadcrumb-item"><a href="">@lang('admin.admins')</a>
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
                    <h4 class="card-title"> @lang('admin.admins')</h4>
                    @if(Auth::guard('admin')->user()->hasPermission('admins-create'))
                    <button class="dt-button create-new btn btn-dark d-inline-flex" type="button" data-toggle="modal"
                        data-target="#modal-add-admin">
                        <span style="font-size: 15px;"> + @lang('admin.addadmins')</span>
                    </button>
                    @else
                    <button class="dt-button create-new btn btn-dark d-inline-flex disabled" type="button">
                        <span style="font-size: 15px;"> + @lang('admin.addadmins')</span>
                    </button>
                    @endif

                </div>
                <div class="card-datatable">
                    <table class="datatables-ajax table table-bordered admin-table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">@lang('admin.name')</th>
                                <th class="text-center">@lang('admin.email')</th>
                                <th class="text-center">@lang('admin.role')</th>
                                <th class="text-center">@lang('admin.active')</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    @if(Auth::guard('admin')->user()->hasPermission('admins-create'))
    <div class="modal modal-slide-in fade" id="modal-add-admin">
        <div class="modal-dialog sidebar-sm">

            <form id="addadmin" method="POST" class="add-new-record modal-content pt-0" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addadmins')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                        <div class="form-group">
                            <label>@lang('admin.name')</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                placeholder="@lang('admin.name')" required />
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.email')</label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control"
                                placeholder="@lang('admin.email')" required />
                        </div>

                        <div class="form-group">
                            <label for="basicSelect"></label>
                            <select class="form-control" name="role_id">
                                <option value="">---</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.password')</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="login-password"
                                    name="password" value="{{ old('password') }}" tabindex="2"
                                    placeholder="@lang('admin.password')" aria-describedby="login-password" required
                                    autofocus />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.password')</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="password-confirm"
                                name="password_confirmation" value="{{ old('password') }}" tabindex="2"
                                    placeholder="@lang('admin.confirmpassword')" required autofocus />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="submit"
                            class="btn btn-dark data-submit mr-1">@lang('admin.save')</button>
                        <button type="reset" class="btn btn-outline-secondary"
                            data-dismiss="modal">@lang('admin.cancel')</button>

                        </div>
                    </form>
        </div>
    </div>
    </div>
    @endif

    <!-- Modal to edit record -->
    @if(Auth::guard('admin')->user()->hasPermission('admins-update'))
    <div class="modal modal-slide-in fade" id="modal-edit-admin">
        <div class="modal-dialog sidebar-sm">
            <form id="editadmin" method="post" class="add-new-record modal-content pt-0" data-parsley-validate>
                @csrf
                @method('put')
                <input type="hidden" name="adminId" id="Admin_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editadmins')</h5>
                </div>

                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <label>@lang('admin.name')</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="@lang('admin.name')" required />
                    </div>

                    <div class="form-group">
                        <label>@lang('admin.email')</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="@lang('admin.email')" required />
                    </div>

                    <div class="form-group">
                        <label for="basicSelect"></label>
                        <select class="form-control" name="role_id" id="role">
                            <option value="">---</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>@lang('admin.password')</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="login-password"
                                name="password" value="{{ old('password') }}" tabindex="2"
                                placeholder="@lang('admin.password')" aria-describedby="login-password"
                                autofocus />
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>@lang('admin.password')</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="password-confirm"
                            name="password_confirmation" value="{{ old('password') }}" tabindex="2"
                                placeholder="@lang('admin.confirmpassword')"  autofocus />
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
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

<script>
    $(function () {
       var locale = '{{ config('app.locale') }}';


       var table = $('.admin-table').DataTable({
             "drawCallback": function( settings ) {
                feather.replace();
             },
           {{--//"language": {"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/{{localsLanguage()[app()->getLocale()]}}.json"},--}}
           "language": {"url": "{{asset('AdminS/assets_ar/app-assets/js/scripts/tables/'. app()->getLocale() . '.json') }}"},
           processing: true,
           serverSide: true,
           ajax: "{{ route('admins.index') }}",
           columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name',searchable: true, sortable : true},
                    {data: 'email', name: 'email',searchable: true, sortable : true},
                    {data: 'role_id', name: 'role_id'},
                    {data: 'active', name: 'active', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
             ],
           responsive:true,
           searching: true,
           order:[0,'desc']
       });
     {{--  if (locale == 'ar') {--}}
     {{--  }else{--}}

     {{--  var table = $('.admin-table').DataTable({--}}
     {{--      "drawCallback": function( settings ) {--}}
     {{--           feather.replace();--}}
     {{--       },--}}
     {{--      "language": {"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/English.json"},--}}
     {{--      processing: true,--}}
     {{--      serverSide: true,--}}
     {{--      ajax: "{{ route('admins.index') }}",--}}
     {{--      columns: [--}}
     {{--               {data: 'id', name: 'id'},--}}
     {{--               {data: 'name', name: 'name',searchable: true, sortable : true},--}}
     {{--               {data: 'email', name: 'email',searchable: true, sortable : true},--}}
     {{--               {data: 'role_id', name: 'role_id'},--}}
     {{--               {data: 'active', name: 'active', orderable: false, searchable: false},--}}
     {{--               {data: 'action', name: 'action', orderable: false, searchable: false},--}}
     {{--      ],--}}
     {{--      responsive:true,--}}
     {{--      searching: true,--}}
     {{--      order:[0,'desc']--}}
     {{--  });--}}
     {{--}--}}

    $('body').on('submit','#addadmin',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admins.store') }}',
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

                    table.ajax.reload();
                    $modal = $('#modal-add-admin');
                    $modal.find('form')[0].reset();
                    $('#modal-add-admin').modal('hide');
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


        $('body').on('click','#check',function () {
            //e.preventDefault();
            var active = $(this).prop('checked') == true ? 1 : 0;
            var admin_id = $(this).data('id');
            $.ajax({
                url:'{{ route('adminactive') }}',
                type:'GET',
                data:{
                    'active': active,
                    'admin_id': admin_id
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
                },
                error: function (response) {
                        var errors = response.responseJSON.errors;
                        $.each(errors, function( index, value ) {
                        toastr.options ={
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

        $('body').on('click','.edit',function (e) {
            e.preventDefault();

            var id = $(this).data('adminid');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var role = $(this).data('role');

            $('#Admin_id').val(id);
            $('#name').val(name);
            $('#email').val(email);
            $('#role').val(role);
        })

        $('body').on('submit','#editadmin',function (e) {
                e.preventDefault();
                let id = $('#Admin_id').val();
                var url = '{{ route('admins.update', ':id') }}';
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
                            // "rtl": isRtl
                        }
                        toastr['success']("@lang('admin.updated')");
                    }
                    $modal = $('#modal-edit-admin');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-admin').modal('hide');
                    $('.admin-table').DataTable().ajax.reload();
                    },
                    error: function (response) {
                        var errors = response.responseJSON.errors;
                        $.each(errors, function( index, value ) {
                        toastr.options ={
                                "closeButton" : true,
                                "progressBar" : true,
                                "showDuration": 500,
                                // "rtl": isRtl
                            }
                        toastr['error'](value);
                        });
                    }

                });
            })


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
                $('.admin-table').DataTable().ajax.reload();
             }
           });
        })

     });
</script>

@endpush
