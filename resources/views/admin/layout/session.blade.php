@if (session('success'))
    <script>
        toastr.options ={
        "closeButton" : true,
        "progressBar" : true,
        "showDuration": 500, 
        // "rtl": isRtl 
        }
        toastr['success']("{{ session('success') }}");
    </script>
@endif

@if (session('error'))
    <script>
              toastr.options ={
        "closeButton" : true,
        "progressBar" : true,
        "showDuration": 500, 
        // "rtl": isRtl 
        }
        toastr['error']("{{ session('error') }}");
    </script>
    {{-- {{ session('error') }} --}}
@endif