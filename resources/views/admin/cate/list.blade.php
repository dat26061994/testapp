@extends('admin.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                    </div>
                     @if(Session::has('flash_message'))
                            <div class="alert alert-{!! Session::get('flash_level') !!}">
                                {!! Session::get('flash_message') !!}
                            </div>
                        @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th style="text-align:center;">ID</th>
                                <th style="text-align:center;">Name</th>
                                <th style="text-align:center;">Orders</th>
                                <th style="text-align:center;">Edit</th>
                                <th style="text-align:center;">Delete</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php $stt = 0;?>
                        @foreach($data as $item)
                        <?php $stt++ ?>
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->orders }}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ URL::route('admin.cate.getEdit',$item->id) }}">Edit</a></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return deleteConfirm('Do you want delete ??')" href="{{ URL::route('admin.cate.getDelete',$item->id) }}"> Delete</a></td>
                                
                            </tr>
                        @endforeach 
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    @endsection