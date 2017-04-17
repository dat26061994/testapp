{!! Form::open(array('route'=>'sendInfor','files'=>true)) !!}
{!! Form::label('user','UserName') !!}
{!! Form::text('txtUser','',array('class'=>'form-control','placeholder'=>'UserName')) !!}</br></br>
{!! Form::label('password','Password') !!}
{!! Form::password('txtPassword','',array('class'=>'form-control'))  !!}</br></br>
{!! Form::label('email','Email') !!}
{!! Form::email('txtEmail','',array('class'=>'form-control'))  !!}</br></br>
{!! Form::label('gender','Gender') !!}
{!! Form::radio('txtGender','Male')  !!}Male
{!! Form::radio('txtGender','female')  !!}Female</br></br>
{!! Form::select('sltCity',array(
    '1' => 'Hà Nội',
    '2' => 'TP.Hồ Chí Minh',
    '3' => 'Đà Nẵng',
)); !!}</br></br>
{!! Form::label('object','Object') !!}
{!! Form::checkbox('object','swift') !!}Swift
{!! Form::checkbox('object','java') !!}java
{!! Form::checkbox('object','C#') !!}C#
{!! Form::hidden('website','google.com') !!}</br></br>
{!! Form::file('img') !!}</br></br>
{!! Form::submit('Submit') !!}
{!! Form::reset('Reset') !!}
{!! Form::button('Ok') !!}
{!! Form::close() !!}