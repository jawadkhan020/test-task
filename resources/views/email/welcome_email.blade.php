<html>
<link  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="width:80%;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #D81B60 ;">
    <thead>
      <tr>

        <th style="text-align:right;font-weight:400;font-weight: bold;">{{date('Y-m-d')}}</th>
      </tr>
      <tr style="height: 15px"></tr>
<tr style="border: solid 1px #ddd;">
        <td colspan="" style=" padding:10px 20px;"> Dear<strong> {{$name}}</strong></td>
      </tr>
      <tr>

        <td style=" padding:10px 20px;" >{{$description}}</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style=" padding:10px 20px;">Email: <strong>{{$to}}</strong></td>
      </tr>
      <tr>
        <td style=" padding:10px 20px;">Password: <strong>{{$password}}</strong></td>
      </tr>
      <tr>
        <td style=" padding:10px 20px;" ><strong >Note :  </strong> Note This is System generated password , Please Update Your Password Ofter Login </td>
        
      </tr>
      <tr>
        <td style=" padding:10px 20px;" ><a href="{{route('admin.login.form')}}"style="text-decoration: none; "><strong>Click here for login</strong></a> </td>
      </tr>
      <tr>
        <td style=" padding:10px 20px;">Regards: <strong>Test Task Car Management Syatem</strong></td>
      </tr>
    </tbody>
  </table>
</body>
</html>