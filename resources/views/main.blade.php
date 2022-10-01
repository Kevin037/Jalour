@include('header')
@yield('judul')
  </head>
  <body>
@include('customer.navbar')
{{-- <div id="aktiv_label_check"> --}}
@yield('isi')
{{-- </div> --}}
@include('footer')

