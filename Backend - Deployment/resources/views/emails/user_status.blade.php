<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CAPS System Notification</title>
</head>

<body style="margin:0;padding:0;background:#f5f6fa;font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0" style="background:white;border-radius:10px;overflow:hidden;box-shadow:0 5px 15px rgba(0,0,0,0.08);">

<!-- HEADER -->
<tr>
<td style="background:#1c1c1c;padding:25px;text-align:center;color:white;">

<h2 style="margin:0;color:#ff6a00;letter-spacing:1px;">
CAPS SYSTEM
</h2>

<p style="margin:5px 0 0;font-size:14px;color:#ccc;">
Comprehensive Assessment and Preparation System
</p>

</td>
</tr>


<!-- BODY -->
<tr>
<td style="padding:35px;">

<p style="font-size:16px;color:#333;">
Hello <strong>{{ $user->firstName ?? $user->name }}</strong>,
</p>


@if($status == 'approved')

<div style="
background:#fff5ef;
border-left:6px solid #ff6a00;
padding:20px;
border-radius:6px;
margin:25px 0;
">

<h3 style="color:#ff6a00;margin-top:0;">
Account Approved
</h3>

<p style="font-size:15px;color:#444;margin:0;">
Good news! Your CAPS account has been successfully approved.
You can now access the system and start using the platform.
</p>

</div>

<p style="font-size:15px;color:#444;">
You may now log in using your registered credentials.
</p>

<a href="http://localhost"
style="
display:inline-block;
margin-top:15px;
padding:12px 28px;
background:#ff6a00;
color:white;
text-decoration:none;
border-radius:6px;
font-weight:bold;
font-size:14px;
">
Login to CAPS
</a>

@elseif($status == 'disapproved')

<div style="
background:#fff2f2;
border-left:6px solid #ff6a00;
padding:20px;
border-radius:6px;
margin:25px 0;
">

<h3 style="color:#ff6a00;margin-top:0;">
Account Disapproved
</h3>

<p style="font-size:15px;color:#444;margin:0;">
Unfortunately, your CAPS account request has been disapproved.
</p>

</div>

<p style="font-size:15px;color:#444;">
If you believe this is a mistake, please contact the system administrator
for further assistance.
</p>

@endif


<p style="margin-top:35px;font-size:14px;color:#666;">
Regards,<br>
<strong>CAPS Administration</strong>
</p>

</td>
</tr>


<!-- FOOTER -->
<tr>
<td style="background:#1c1c1c;color:#aaa;text-align:center;padding:15px;font-size:12px;">

© {{ date('Y') }} CAPS System  
Jose Rizal Memorial State University

</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>