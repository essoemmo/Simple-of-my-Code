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

<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
              
                        <form action="{{route('roles.update',$role->id)}}"  method="POST" class="add-new-record modal-content pt-0" data-parsley-validate>
                            @csrf
                            @method('put')

                             <div class="modal-header mb-1">
                                 <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editroles')</h5>
                             </div>
                             <div class="modal-body flex-grow-1">
             
                               <div class="form-group">
                                     <label class="form-label">@lang('admin.namerole')</label>
                                     <input type="text" name="name" value="{{$role->name}}"  required
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
                                                 <td class="col-sm-8 col-xl-4 m-b-30">
                                                     <select class="select2 form-control" name="permissions[]" multiple = "multiple">
                                                         @foreach($actions as $index=>$action)
             
                                                         <option value="{{$model.'-'.$action}}" {{$role->hasPermission($model.'-'.$action) ? 'selected':''}}>@lang('admin.'.$action)</option>
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
                                     style="float: right">@lang('admin.cancel')</button>
                             </div>
                         </form>
                  
                </div> 
            </div>
        </div>
    </div>
</section>
@endsection