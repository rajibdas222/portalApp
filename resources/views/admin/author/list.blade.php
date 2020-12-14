@extends('admin.layout.master')
@section('content')


    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header">
                <div class="page-title">
                    <h1>{{$page_name}}</h1>

                </div>

            </div>

        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Table</a></li>
                        <li class="active">Data table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">

                        @if($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif


                        <div class="card-header d-flex justify-content-between">
                            <strong class="card-title">{{$page_name}}</strong>
                            <a href="{{url('back/author/create ')}}" class="btn btn-primary btn-lg">Create</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>ID#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($authors as $i=>$row)


                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->roles()->pluck('name')->implode(' | ') }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ url('back/author/edit/'.$row->id) }}">Edit</a>
                                            {!! Form::open(['method' => 'DELETE','url' => ['back/author/delete/'.$row->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>


                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->


    <link rel="stylesheet" href="{{asset('public/admin/assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">

    <script src="{{asset('public/admin/assets/js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/jszip.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/pdfmake.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/vfs_fonts.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/lib/data-table/datatables-init.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#bootstrap-data-table-export').DataTable();
        });
    </script>




@endsection
