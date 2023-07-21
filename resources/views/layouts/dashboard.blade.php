<!DOCTYPE html>
<html data-theme="light" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://kit.fontawesome.com/6f0249e16e.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
    {{-- @vite('resources/css/app.css') --}}
</head>
<body>
    @include('sections.header')
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col bg-gray-800 text-gray-50">
          <!-- Page content here -->
          {{-- <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label> --}}
          @yield('pages')

        </div>
        <div class="drawer-side">
          <label for="my-drawer-2" class="drawer-overlay"></label>
          <ul class="menu p-4 w-80 h-full bg-base-200 text-base-content">
            <!-- Sidebar content here -->
            <li><a href="{{ route('add.product.page') }}">Add Product</a></li>
            <li><a href="{{ route('stock.in.page') }}" >Stock In</a></li>
            <li><a id="stock_collection_route" href="{{ route('stock.collection.page') }}" >Stock Collection</a></li>
          </ul>

        </div>
      </div>



      @include('sections.add_supplier_modal')
      @include('sections.details_modal')
      @include('sections.add_size_modal')
      @include('sections.invoiceDeleteConfirmModal')
      @include('sections.invoice_product_delete_confirm_modal')

      @include('sections.details_drawer')




      @include('pages.dashboard_pages.add_product_js')
      @include('pages.dashboard_pages.stock_in_js')
      @include('sections.supplier_collection_js')
      @include('sections.invoice_js')
      @include('pages.dashboard_pages.stock_collection_js')
      @include('sections.details_drawer_js')
      @include('sections.product_stock_js')
      @include('sections.invoice_stock_js')
      {!! Toastr::message() !!}
</body>
</html>
