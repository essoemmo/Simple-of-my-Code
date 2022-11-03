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

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered user-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="typesList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">@lang('admin.kids')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body" id="ShowKids">

                    </div>
            </div>
        </div>
    </div>

    {{-- <!-- Modal to add new record -->
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
    @endif --}}

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

    $('body').on('click','.kids',function () {
        var user_id = $(this).data('id');
        $.ajax({
            url:'{{ route('getkids') }}',
            type:'GET',
            data:{
                'user_id': user_id
            },
            success: function (response) {
                    var docRow = '';
                    $('#ShowKids').html('');
                    $.each(response, function(index, value){
                      docRow = '<span style="font-size: x-large;">'+value.name+'</span><span style="float: right;font-size: x-large;">'+value.id_number+'</span><br>';

                    $('#ShowKids').append(docRow);

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

    
</script>
@endpush
