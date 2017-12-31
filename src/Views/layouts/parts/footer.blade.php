@if( config('shop.active') === true )
@include('vendor.decoweb.layouts.scripts.cart')
@endif
@yield('footer-assets')
</body>
</html>