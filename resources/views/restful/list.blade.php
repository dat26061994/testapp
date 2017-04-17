<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Khoa Phạm - Quản Lý Học Sinh</title>
    <link type="text/css" href="{!! url('public/restful/css/bootstrap.min.css') !!}" rel="stylesheet">
    <style type="text/css">
      .btn {padding:0px;font-weight:bold}
    </style>
    <script type="text/javascript">
        function xacnhanxoa(msg) {
            if (window.confirm(msg)) {
                return true;
            }
            return false;
        }
    </script>
  </head>
  <body>
    <div class="container" style="margin-top:20px">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Danh Sách Học Sinh</h3>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>STT</th>
                <th>Họ Tên</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Country</th>
                <th>Thêm</th>
                <th>Xóa</th>
                <th>Sửa</th>
              </tr>
            </thead>
            <tbody>
            <?php $stt = 0; ?>
            @foreach($student as $sts)
             <?php $stt++ ?>
              <tr>
                <th scope="row">{{ $stt }}</th>
                <td>{{ $sts->name }}</td>
                <td>{{ $sts->phone }}</td>
                <td>{{ $sts->email }}</td>
                <td>{{ $sts->gender }}</td>
                <td>{{ $sts->country }}</td>
                <th><a href="{!! route('students.create') !!}">Thêm</a></th>
                <th>
                  {!! Form::open(array('route'=>array('students.destroy',$sts->id),'method'=>'DELETE')) !!}
                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link">Xóa</button>
                  
                  {!! Form::close() !!}
                </th>
                <th><a href="{!! route('students.edit',$sts->id) !!}">Sửa</a></th>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
   
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>