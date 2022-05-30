
<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{ now()->year }} <a class="ml-25" href="#" target="_blank">Wnes</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->

@if (app()->getlocale() == 'ar')
<!-- BEGIN: Vendor JS-->
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('AdminS/assets_ar/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('AdminS/assets_ar/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/js/scripts/tables/table-datatables-basic.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/js/scripts/forms/form-select2.js')}}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

{{--parsly--}}
<script src="{{asset('AdminS/parsley/parsley.min.js')}}"></script>
<script src="{{asset('AdminS/i18n/ar.js')}}"></script>

@else

<!-- BEGIN: Vendor JS-->

<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('AdminS/assets_en/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('AdminS/assets_en/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/js/scripts/tables/table-datatables-basic.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
<script src="{{asset('AdminS/assets_en/app-assets/js/scripts/forms/form-select2.js')}}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

{{--parsly--}}
<script src="{{asset('AdminS/parsley/parsley.min.js')}}"></script>
<script src="{{asset('AdminS/i18n/en.js')}}"></script>

@endif

@stack('js')


<script>
// image preview

$(".image").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-show').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }
});

$(".cover").change(function () {

if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('.cover-show').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]);
}
});

</script>

<script>
//delete
$('body').on('click', '.delete', function (e) {
    var that = $(this)
    e.preventDefault();
    Swal.fire({
        title: "@lang('admin.deleteconfirm')",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "@lang('admin.yes')",
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.isConfirmed) {
            that.closest('form').submit();
            Swal.fire({
            icon: 'success',
            title: "@lang('admin.deleted')!",
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
         }
      });

}); //end of delete


</script>
</body>

</html>
