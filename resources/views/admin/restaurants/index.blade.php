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

                    <li class="breadcrumb-item"><a href="">@lang('admin.restaurants')</a>
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
                    <h4 class="card-title"> @lang('admin.restaurants')</h4>
                    @if(Auth::guard('admin')->user()->hasPermission('restaurants-create'))
                    <button class="dt-button create-new btn btn-dark d-inline-flex" type="button" data-toggle="modal"
                        data-target="#modal-add-restaurant">
                        <span style="font-size: 15px;">+ @lang('admin.addrestaurants')</span>
                    </button>
                    @else
                    <button class="dt-button create-new btn btn-dark d-inline-flex disabled" type="button">
                        <span style="font-size: 15px;">+ @lang('admin.addrestaurants')</span>
                    </button>
                    @endif

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                        'class'=> 'datatables-ajax table table-bordered restaurant-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    @if(Auth::guard('admin')->user()->hasPermission('restaurants-create'))
    <div class="modal modal-slide-in fade" id="modal-add-restaurant">
        <div class="modal-dialog sidebar-sm">
            <form id="addrestaurant" method="POST" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addrestaurants')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                        <div class="form-group">
                            <img src="" width="130" height="130" alt="" style="margin-left: 75px; border-radius: 60px;" class="image-show img-circle"/>
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
                            <img src="" width="130" height="130" alt="" style="width: 100%;" class="cover-show"/>
                        </div>

                        <div class="form-group">
                            <label for="customFile">@lang('admin.cover')</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input cover" name="cover" id="cover" />
                                <label class="custom-file-label" for="customFile">@lang('admin.cover')</label>
                            </div>
                        </div>

                        <div class="form-group" id="map" style="height: 250px">
                        </div>

                        <div class="form-group">
                            <label for="customFile">@lang('admin.lat') </label>
                            <input type="text" id="lat" class="form-control" name="lat">
                        </div>

                        <div class="form-group">
                            <label for="customFile">@lang('admin.lang') :</label>
                            <input type="text" id="lang" class="form-control" name="lang">
                        </div>

                        <div class="form-group">
                            <label class="form-label" >@lang('admin.address')</label>
                            <input type="text" name="address" id="address"  class="form-control"/>
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
    @if(Auth::guard('admin')->user()->hasPermission('restaurants-update'))
    <div class="modal modal-slide-in fade" id="modal-edit-restaurant">
        <div class="modal-dialog sidebar-sm">
            <form id="editrestaurant" method="post" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>
               @csrf
               @method('put')
               <input type="hidden" name="restaurantId" id="Restaurant_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editrestaurants')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <img src="" width="130" height="130" alt="" style="margin-left: 75px; border-radius: 60px;" class="image-show img-circle"/>
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
                        <label for="customFile">@lang('admin.cover')</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input cover" name="cover" id="cover" />
                            <label class="custom-file-label" for="customFile">@lang('admin.cover')</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <img src="" width="130" height="130" alt="" style="width: 100%;" class="cover-show"/>
                    </div>

                    <div class="form-group">
                        <label class="form-label" >@lang('admin.address')</label>
                        <input type="text" name="address" value="{{old('address')}}" parsley-trigger="change" 
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

        $('body').on('submit','#addrestaurant',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('restaurants.store') }}',
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
                    $('.restaurant-table').DataTable().ajax.reload();
                    $modal = $('#modal-add-restaurant');
                    $modal.find('form')[0].reset();
                    $('#modal-add-restaurant').modal('hide');
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
            var restaurant_id = $(this).data('id');
            $.ajax({
                url:'{{ route('restaurantactive') }}',
                type:'GET',
                data:{
                    'active': active,
                    'restaurant_id': restaurant_id
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
            var id = $(this).data('restaurantid');
            var name = $(this).data('name');
            var phone = $(this).data('phone');
            var email = $(this).data('email');
            var address = $(this).data('address');
            var lat = $(this).data('lat');
            var lang = $(this).data('lang');
            var photo = $(this).data('restaurant_image');
            var cover = $(this).data('restaurant_cover');
            var photo_url = "{{url('')}}/" + photo;
            var cover_url = "{{url('')}}/" + cover;

            $('#Restaurant_id').val(id);
            $('#name').val(name);
            $('#phone').val(phone);
            $('#email').val(email);
            $('#address').val(address);
            $('#lat').val(lat);
            $('#lang').val(lang);
            $('.image-show').attr('src',photo_url);
            $('.cover-show').attr('src',cover_url);

        })

      $('body').on('submit','#editrestaurant',function (e) {
                e.preventDefault();
                let id = $('#Restaurant_id').val();
                var url = '{{ route('restaurants.update', ':id') }}';
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
                    $('.restaurant-table').DataTable().ajax.reload();
                    $modal = $('#modal-edit-restaurant');
                    $modal.find('form')[0].reset();
                    $('#modal-edit-restaurant').modal('hide');
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
                $('.restaurant-table').DataTable().ajax.reload();
             }
           });
        })
    
</script>

<script>
    var map;
    var markers = [];

    function initMap() {
        var haightAshbury = {
            lat: 24.713866131913335, 
            lng: 46.675723737695755
        };

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: haightAshbury,
            mapTypeId: 'terrain'
        });
         geocoder = new google.maps.Geocoder();
        $('#lat').val('24.713866131913335');
        $('#lang').val('46.675723737695755');
        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
            addMarker(event.latLng);
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();
            // console.log(event);
            geocoder.geocode({ 'latLng': event.latLng }, function(results, status) {
                if (status !== google.maps.GeocoderStatus.OK) {
                    alert(status);
                }
               if (status == google.maps.GeocoderStatus.OK) {
                //    console.log(results);
                   var address = (results[1].formatted_address);
                   $('#address').val(address);
                }
            });
    
            $('#lat').val(latitude);
            $('#lang').val(longitude);
           
        });

        // Adds a marker at the center of the map.
        addMarker(haightAshbury);
    }

    // Adds a marker to the map and push to the array.
    function addMarker(location) {
        clearMarkers();
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        markers.push(marker);
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

    // Shows any markers currently in the array.
    function showMarkers() {
        setMapOnAll(map);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU6YNVxesC2-qRF2yDgCk7be8QaQz56kQ&libraries=places&callback=initMap">
</script>

@endpush
