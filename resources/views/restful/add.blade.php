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
          <h3 class="panel-title">Thêm Học Sinh</h3>
        </div>
        <div class="panel-body">
          <form method="POST" action="{!! route('students.store') !!}" name="frmAdd">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
              <label for="lblHoTen">Họ Tên </label>
              <input type="text" class="form-control" name="txtName" />
            </div>
            <div class="form-group">
              <label for="lblsdt">Số Điện Thoại</label>
              <input type="text" class="form-control" name="txtPhone" />
            </div>
            <div class="form-group">
              <label for="lblEmail">Email</label>
              <input type="text" class="form-control" name="txtEmail" />
            </div>
            <div class="form-group">
              <label for="lblGender">Gender</label>
              <input type="text" class="form-control" name="txtGender" />
            </div>
            <div class="form-group">
              <label for="lblCountry">Country</label>
              <input type="text" class="form-control" name="txtCountry" />
            </div>
            <button type="submit" class="btn btn-default">Thêm</button>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>