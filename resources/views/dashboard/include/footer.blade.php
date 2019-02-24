<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        <a href="https://www.facebook.com/adel.abuelzz" target="_blank">Adel Abou Elezz</a>
    </div>
    <!-- Default to the left -->
</footer>
<div class="control-sidebar-bg"></div>
</div>

{{--<!-- jQuery 2.2.3 -->--}}
{{--<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>--}}
{{--<!-- Bootstrap 3.3.6 -->--}}
{{--<script src="../../bootstrap/js/bootstrap.min.js"></script>--}}
{{--<!-- DataTables -->--}}
{{--<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>--}}
{{--<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>--}}
{{--<!-- SlimScroll -->--}}
{{--<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>--}}
{{--<!-- FastClick -->--}}
{{--<script src="../../plugins/fastclick/fastclick.js"></script>--}}
{{--<!-- AdminLTE App -->--}}
{{--<script src="../../dist/js/app.min.js"></script>--}}
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="../../dist/js/demo.js"></script>--}}
{{--<!-- page script -->--}}
{{--<script>--}}
{{--$(function () {--}}
{{--$("#example1").DataTable();--}}
{{--$('#example2').DataTable({--}}
{{--"paging": true,--}}
{{--"lengthChange": false,--}}
{{--"searching": false,--}}
{{--"ordering": true,--}}
{{--"info": true,--}}
{{--"autoWidth": false--}}
{{--});--}}
{{--});--}}

<script src="{{ asset('lang/'.app()->getLocale().'.js') }}" type="text/javascript"></script>
<!-- jQuery 2.2.3 -->
<script src="{{ asset('dashboard/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('dashboard/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('dashboard/dist/js/app.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@yield('js')
<script src="{{ asset('js/main.js') }}"></script>


</body>
</html>
