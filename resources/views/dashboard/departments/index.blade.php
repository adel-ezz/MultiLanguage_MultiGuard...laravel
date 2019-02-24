@extends('dashboard.layout')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">@lang('Departments')</h3>
                            <button class="btn btn-primary pull-left" data-toggle="modal"
                                    data-target="#AddModal">@lang('Add New') <i
                                        class="fa fa-plus"></i></button>
                            <div class="modal fade" id="AddModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                            <h4 class="modal-title"><i
                                                        class="fa fa-plus"></i> @lang('Add New')</h4>
                                        </div>
                                        <form action="{{ route('departs.store') }}"
                                              method="post">
                                            <div class="modal-body">
                                                {{ csrf_field() }}
                                                @foreach(langs() as $lang)
                                                    <div class="form-group" style="width: 100%!important;">
                                                        <label for="name_{{$lang}}">@lang('name') @lang($lang)</label>
                                                        <br>
                                                        <input type="text" class="form-control"
                                                               id="name_{{$lang}}" name="name_{{$lang}}" required
                                                               style="width: 100%!important;"
                                                               value="{{ old('name_'.$lang) }}"
                                                               placeholder="@lang('name') @lang($lang)">
                                                    </div>
                                                @endforeach
                                                <br>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit"
                                                        class="btn btn-primary add-entry">@lang('Add New')</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('name') @lang('ar')</th>
                                    <th>@lang('name') @lang('en')</th>
                                    <th>@lang('created_at')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--@foreach($admins as $key=>$admin)--}}
                                {{--<tr>--}}
                                {{--<td>{{ $key++ }}</td>--}}
                                {{--<td>--}}
                                {{--<a href="#" id="name" class="editable" data-type="text" data-pk="{{ $admin->id }}"--}}
                                {{--data-url="{{ route('admins.update',['id'=>$admin->id]) }}"--}}
                                {{--data-title="@lang('name')">{{$admin->name}}</a></td>--}}
                                {{--<td>--}}
                                {{--<a href="#" id="email" class="editable" data-type="email" data-pk="{{ $admin->id }}"--}}
                                {{--data-url="{{ route('admins.update',['id'=>$admin->id]) }}"--}}
                                {{--data-title="@lang('email')">{{$admin->email}}</a>--}}
                                {{--</td>--}}

                                {{--<td>--}}
                                {{--<button class="btn btn-sm btn-info"--}}
                                {{--data-toggle="modal" data-target="#myModal_{{ $admin->id }}"--}}
                                {{--style="margin: 4px 0;min-width: 85px;"--}}
                                {{--><i class="fa fa-pencil"></i>--}}
                                {{--@lang('Edit Password') </button>--}}
                                {{--<div class="modal fade" id="myModal_{{ $admin->id }}" role="dialog">--}}
                                {{--<div class="modal-dialog">--}}
                                {{--<!-- Modal content-->--}}
                                {{--<div class="modal-content">--}}
                                {{--<div class="modal-header">--}}
                                {{--<button type="button" class="close" data-dismiss="modal">--}}
                                {{--&times;--}}
                                {{--</button>--}}
                                {{--<h4 class="modal-title"><i--}}
                                {{--class="fa fa-pencil"></i> @lang('Edit Password')</h4>--}}
                                {{--</div>--}}
                                {{--<form action="{{ route('admins.update',['id'=>$admin->id]) }}"--}}
                                {{--method="post">--}}
                                {{--<div class="modal-body">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<input name="_method" type="hidden" value="PUT">--}}
                                {{--<div class="form-group" style="width: 100%!important;">--}}
                                {{--<label for="password">@lang('password')</label>--}}
                                {{--<br>--}}
                                {{--<input type="password" class="form-control"--}}
                                {{--id="password" name="password" required--}}
                                {{--style="width: 100%!important;"--}}
                                {{--placeholder="@lang('password')">--}}
                                {{--</div>--}}
                                {{--<br>--}}
                                {{--<div class="form-group" style="width: 100%!important;">--}}
                                {{--<label for="password-confirm">@lang('confirm password')</label>--}}
                                {{--<br>--}}
                                {{--<input type="password" class="form-control"--}}
                                {{--id="password-confirm" name="password_confirm"--}}
                                {{--required style="width: 100%!important;"--}}
                                {{--placeholder="@lang('confirm password')">--}}
                                {{--</div>--}}

                                {{--</div>--}}
                                {{--<div class="modal-footer">--}}
                                {{--<button type="submit"--}}
                                {{--class="btn btn-primary update-entry">@lang('save')</button>--}}
                                {{--</div>--}}
                                {{--</form>--}}
                                {{--</div>--}}

                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<form action="{{ route('admins.destroy',['id'=>$admin->id]) }}" method="POST"--}}
                                {{--style="display:inline-block">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--{{ method_field('DELETE') }}--}}
                                {{--<input type="hidden" name="_method" value="DELETE">--}}

                                {{--<button class="btn btn-sm btn-danger delete-entry"--}}
                                {{--style="margin: 4px 0;min-width: 85px;" {{ $admin->id == 1 ? 'disabled':'' }} type="submit"><i--}}
                                {{--class="fa fa-times"></i> @lang('Delete')--}}
                                {{--</button>--}}
                                {{--</form>--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                                {{--@endforeach--}}
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- ./wrapper -->
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap.css')}}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>

@endsection
@section('js')
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script>

        $('#example1').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": false,
            "language": {
                search: __['search'],
                paginate: {
                    "first": __['start'],
                    "last": __['end'],
                    "next": __['next'],
                    "previous": __['previous']
                },
                zeroRecords: __['no element founded'],
                processing: __['search'],
                "lengthMenu": ' <select>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="30">30</option>' +
                '<option value="40">40</option>' +
                '<option value="50">50</option>' +
                '<option value="-1">All</option>' +
                '</select>' + __['element'],
                loadingRecords: __['load'],
                "info": __['show'] + " _END_ " + __['from'] + " _TOTAL_ " + __['element'],
                "infoEmpty": __['show'] + " 0 " + __['from'] + "0 " + __['to'] + " 0" + __['element'],
                "infoFiltered": "(filtered from _MAX_ total entries)",
            },
            "ajax": "{{route('getAllDeparts')}}",
            "columns": [
                {"data": "id", name: 'id', orderable: false, searchable: false},
                {"data": "name_ar", name: 'name_ar', orderable: false},
                {"data": "name_en", name: 'name_en', orderable: false},
                {"data": "created_at", name: 'created_at', orderable: false},
                {"data": "action", name: 'action', orderable: false, searchable: false},
            ],
            "initComplete": function () {
                $.fn.editable.defaults.mode = 'inline';
                $('.editable').editable({
                    ajaxOptions: {
                        type: 'put',
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    },
                    type: 'text',
                    title: __['Put Valid Data'],
                    validate: function (value) {
                        if (value === null || value === '') {
                            return __['required'];
                        }
                    }, success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }

                });
            }

        });
    </script>

@endsection
<!-- REQUIRED JS SCRIPTS -->
