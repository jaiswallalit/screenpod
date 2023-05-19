<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{$title}}</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
</head>

<body style="margin:0; padding:0;">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" style="padding:5px 0;">
    	<a href="#" target="_blank"><img src="{{asset('assets/front/images/logo.png')}}" alt="" border="0" style="display:inline-block; margin:0; padding: 0;" width="100px"></a>
    </td> 
  </tr>
  @yield('content')
  <tr>
    <td align="center" valign="top" style="background:#243f8f; padding:15px 0; font-family:'Arial Black', Gadget, sans-serif; font-size:12px; line-height:15px; font-weight:300; color:#fff;"> <b>Screenpod<br>
                       Copyright © 2023 Screenpod. All rights reserved.</b></td>
  </tr>
</table>
</body>
</html>