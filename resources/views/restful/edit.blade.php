<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Quản Lý Học Sinh</title>
    <link type="text/css" href="{!! url('public/restful/css/bootstrap.min.css') !!}" rel="stylesheet">
  </head>
  <body>
    <div class="container" style="margin-top:20px">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Sửa Thông Tin Học Sinh</h3>
        </div>
        <div class="panel-body">
          {!! Form::open(array('route'=>array('students.destroy',$data['id']),'method'=>'PUT')) !!}
            <div class="form-group">
              <label for="lblHoTen">Họ Tên </label>
              <input type="text" class="form-control" name="txtHoTen" value="{!! old('txtHoten',isset($data) ? $data['name'] : null) !!}" />
            </div>
            <div class="form-group">
              <label for="lblSdt">Số Điện Thoại</label>
              <input type="text" class="form-control" name="txtPhone" value="{!! old('txtHoten',isset($data) ? $data['phone'] : null) !!}"/>
            </div>
            <div class="form-group">
              <label for="lblEmail">Email</label>
              <input type="text" class="form-control" name="txtEmail" value="{!! old('txtHoten',isset($data) ? $data['email'] : null) !!}"/>
            </div>
            <div class="form-group">
              <label for="lblGender">Gender</label>
              <input type="text" class="form-control" name="txtGender" value="{!! old('txtHoten',isset($data) ? $data['gender'] : null) !!}"/>
            </div>
            <div class="form-group">
              <label for="lblCountry">Country</label>
              <input type="text" class="form-control" name="txtCountry" value="{!! old('txtHoten',isset($data) ? $data['country'] : null) !!}"/>
            </div>
            <button type="submit" class="btn btn-default">Edit</button>
         {!! Form::close() !!}
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>