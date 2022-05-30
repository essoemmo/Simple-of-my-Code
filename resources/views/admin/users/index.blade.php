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

                    <li class="breadcrumb-item"><a href="">@lang('admin.users')</a>
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
                    <h4 class="card-title"> @lang('admin.users')</h4>
                    @if(Auth::guard('admin')->user()->hasPermission('users-create'))
                    <button class="dt-button create-new btn btn-dark d-inline-flex" type="button" data-toggle="modal"
                        data-target="#modal-add-user">
                        <span style="font-size: 15px;">+ @lang('admin.addusers')</span>
                    </button>
                    @else
                    <button class="dt-button create-new btn btn-dark d-inline-flex disabled" type="button">
                        <span style="font-size: 15px;">+ @lang('admin.addusers')</span>
                    </button>
                    @endif

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered user-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    @if(Auth::guard('admin')->user()->hasPermission('users-create'))
    <div class="modal modal-slide-in fade" id="modal-add-user">
        <div class="modal-dialog sidebar-sm">
            <form id="adduser" method="POST" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addusers')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                        <div class="form-group">
                            <img src="{{asset('uploads/users/default.png')}}" 
                            width="130" height="130" alt="" 
                            style="margin-left: 75px; border-radius: 60px;" 
                            class="image-show img-circle"/>
                         </div>

                        <div class="form-group">
                            <label class="form-label">@lang('admin.name')</label>
                            <input type="text" name="name" value="{{old('name')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.name')" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('admin.email')</label>
                            <input type="email" name="email"value="{{old('email')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.email')" class="form-control"  required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" >@lang('admin.phone')</label>
                            <input type="text" name="phone" value="{{old('phone')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.phone')" class="form-control"  required />
                        </div>

                        <div class="form-group">
                            <label for="customFile">@lang('admin.imageprofile')</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input image" name="image" id="image" />
                                <label class="custom-file-label" for="customFile">@lang('admin.imageprofile')</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" >@lang('admin.address')</label>
                            <input type="text" name="address" value="{{old('address')}}" parsley-trigger="change" 
                            placeholder="@lang('admin.address')" class="form-control" required/>
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
                            <label>@lang('admin.confirmpassword')</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="password-confirm"
                                name="password_confirmation" value="{{ old('password') }}" tabindex="2"
                                    placeholder="@lang('admin.confirmpassword')"  autofocus />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
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
    @endif

     <!-- Modal to edit record -->
    @if(Auth::guard('admin')->user()->hasPermission('users-update'))
    <div class="modal modal-slide-in fade" id="modal-edit-user">
        <div class="modal-dialog sidebar-sm">
            <form id="edituser" method="post" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
               @csrf
               @method('put')
               <input type="hidden" name="userId" id="User_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editusers')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <img src=""
                        width="130" height="130" alt="" 
                        style="margin-left: 75px; border-radius: 60px;" 
                        class="image-show img-circle"/>
                     </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.name')</label>
                        <input type="text" name="name" id="name" parsley-trigger="change" 
                        placeholder="@lang('admin.name')" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.email')</label>
                        <input type="email" name="email" id="email" parsley-trigger="change" 
                        placeholder="@lang('admin.email')" class="form-control"  required />
                    </div>

                    <div class="form-group">
                        <label class="form-label" >@lang('admin.phone')</label>
                        <input type="text" name="phone" id="phone" parsley-trigger="change" 
                        placeholder="@lang('admin.phone')" class="form-control"  required />
                    </div>

                    <div class="form-group">
                        <label for="customFile">@lang('admin.imageprofile')</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input image" name="image" id="image" />
                            <label class="custom-file-label" for="customFile">@lang('admin.imageprofile')</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" >@lang('admin.address')</label>
                        <input type="text" name="address" id="address" parsley-trigger="change" 
                        placeholder="@lang('admin.address')" class="form-control" required/>
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

        $('body').on('submit','#adduser',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('users.store') }}',
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
                    $('.user-table').DataTable().ajax.reload();
                    $modal = $('#modal-add-user');
                    $modal.find('form')[0].reset();
                    $('#modal-add-user').modal('hide');
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

      $('body').on('click','.edit',function (e) {

            e.preventDefault();
            var id = $(this).data('userid');
            var name = $(this).data('name');
            var phone = $(this).data('phone');
            var email = $(this).data('email');
            var address = $(this).data('address');
            var photo = $(this).data('user_image');
            var photo_url = "{{url('')}}/" + photo ;

            $('#User_id').val(id);
            $('#name').val(name);
            $('#phone').val(phone);
            $('#email').val(email);
            $('#address').val(address);
            $('.image-show').attr('src',photo_url);
        })

      $('body').on('submit','#edituser',function (e) {
                e.preventDefault();
                let id = $('#User_id').val();
                var url = '{{ route('users.update', ':id') }}';
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
                    $('.user-table').DataTable().ajax.reload();
                    $modal = $('#modal-edit-user');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-user').modal('hide');
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
                $('.user-table').DataTable().ajax.reload();
             }
           });
        })
    
</script>
@endpush
