<?php
error_reporting(0);
echo '<head>
  <title>Smart Tools Shop - Email sending tester</title>
</head>
<body><b><color>Smart Tools Shop - Email sending tester</color></b><br>Write your email and click on send email test<br>
<form method="post">
<input type="email" name="email" style="background-color:whitesmoke;border:1px solid #FFF;outline:none;" required="" placeholder="username@domain.tld" value="' . $_POST['email'] . '">
<input type="submit" name="send" value="Send Email Test" style="border:none;background-color: #65d05e;color:#fff;cursor:pointer;">
</form>
<br>
</body>';
if (isset($_POST['email']))
{
	$rnd = rand();
	mail($_POST['email'],"Email Sending Test Report ID: " . $rnd ,"WORKING!");
	print "<font color=orange><b>Email Sent To: " . $_POST['email'] . ", Report ID: " . $rnd . "</b></font>"; 
}