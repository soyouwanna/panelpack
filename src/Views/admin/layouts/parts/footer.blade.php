<!-- footer content -->
<footer>
    <div class="pull-right">
         Site realizat de <a href="http://www.decoweb.ro">Decoweb Designs SRL</a> Constanta
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<script src="{{ asset('assets/admin/vendors/decoweb/js/jquery.tablednd.0.7.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
@yield('footer-assets')
<script src="{{ asset('assets/admin/build/js/custom.min.js') }}"></script>
@if(defined('EDITOR'))
<script>
  CKEDITOR.replace( 'my-editor', {
      filebrowserImageBrowseUrl: '{!! url('/laravel-filemanager?type=Images') !!}',
      filebrowserImageUploadUrl: '{!! url('/laravel-filemanager/upload?type=Images&_token='.csrf_token()) !!}',
      filebrowserBrowseUrl: '{!! url('/laravel-filemanager?type=Files') !!}',
      filebrowserUploadUrl: '{!! url("/laravel-filemanager/upload?type=Files&_token=".csrf_token()) !!}'
  });
</script>
@endif

</body>
</html>