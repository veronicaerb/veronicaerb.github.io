<?php
// If the form was submitted
if (count($_POST) > 0) {
	require_once('recaptchalib.php');
	$privatekey = "6Lf5ZwgAAAAAAMgLdx3965YUYoblzb_jWDBPGFPr";
	$resp = recaptcha_check_answer ($privatekey,
		$_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"],
		$_POST["recaptcha_response_field"]);

	$name = $_POST['name'];
	$email = $_POST['email'];
	$data = $_POST['data'];
	$error_message = '';
	if ($resp->is_valid) {
		$to = 'veronicaerb@gmail.com';
		$subject = 'Contact Form on veronicaerb.com';
		$message = 'From: ' . $name . "\n\n" . $data;
		$headers = 'From: ' . $email . "\r\n" .
			'Reply-To: ' . $email . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		mail ($to, $subject, $message, $headers);
		header("Location: ttyl.html");
		exit;
	} else {
		$error_message = <<<EOL
			<div class="errorMsg">
				<p>The reCAPTCHA wasn't entered correctly. Give it another shot.</p>
			</div><!--errorMsg-->
EOL;
	}
} else {
	$name = '';
	$email = '';
	$data ='';
	$error_message = '';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Contact > Veronica Erb | verbistheword</title>
<link rel="stylesheet" type="text/css" href="main.css" />
<link rel="icon" href="../image/favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<!-- Special thanks to Ian Greenleaf Young http://blog.iangreenleaf.com/ for writing the PHP to remember user input! -->
</head>

<body>

<div id="wrapper">

	<div class="header">
	<div id="branding" class="group">
		<h1><a href="index.html">Veronica Erb</a></h1>
		<ul class="group">
			<li><a href="http://verbistheword.wordpress.com" class="external-link">Blog</a></li>
			<li><a href="resume.html">Resume</a></li>
			<li><a href="portfolio.html">Portfolio</a></li>
			<li class="current"><a href="contact.php">Contact</a></li>
		</ul>
	</div><!-- #branding -->
	</div><!-- #header -->

	<div id="content">
		<div id="content-wrapper" class="twoColumn">
		
		<h2>Contact Veronica</h2>

<?php echo $error_message; ?>
			<!-- testing PHP mail form from 1and1.com -->
			<form method="post" onsubmit="return validate_form(this);" action="contact.php" >
			<fieldset>
				<label id="name">Name</label>
				<input type="text" name="name" value="<?php echo htmlentities($name); ?>"/>
				
				<label id="email">Email address</label>
				<input type="text" name="email" value="<?php echo htmlentities($email); ?>"/>
				
				<label id="data">What's up?</label>
				<textarea name="data" cols="40" rows="6"><?php echo htmlentities($data); ?></textarea>
				
				<div id="reCAPTCHA">
					<!--reCAPTCHA theme -->
					<script type="text/javascript">
						 var RecaptchaOptions = {
							theme : 'white'
						 };
					</script>

					<!-- reCAPTCHA with js -->
					<script type="text/javascript" src="http://api.recaptcha.net/challenge?k=6Lf5ZwgAAAAAAJpTVVkl3FkIHHwjy-ctlPJhnHKk">
					</script>

					<!-- reCAPTCHA without js -->
					<noscript>
					   <iframe src="http://api.recaptcha.net/noscript?k=6Lf5ZwgAAAAAAJpTVVkl3FkIHHwjy-ctlPJhnHKk"
						   height="300" width="500" frameborder="0"></iframe><br />
					   <textarea name="recaptcha_challenge_field" rows="3" cols="40">
					   </textarea>
					   <input type="hidden" name="recaptcha_response_field" 
						   value="manual_challenge" />
					</noscript>
				</div><!-- #reCAPTCHA -->
			
				<input type="submit" value="Send"/>
			</fieldset>			
			</form>

		
		</div><!-- #content-wrapper -->
		
		<div class="infobox">
			<img class="portrait" src="images/VErbPortrait_150px.jpg" alt="Welcome!" />
			<div class="twitter triangle-border top">
				<p style="margin: .5em">Or, tweet <a href="http://twitter.com/verbistheword">@verbistheword on Twitter</a>.</p>
			</div>
		</div><!-- .infobox -->
		
	</div><!-- #content -->
</div> <!-- #wrapper -->			

<!-- client-side form validation -->
<script type="text/javascript">
function validate_email(field,alerttxt)
{
with (field)
  {
  apos=value.indexOf("@");
  dotpos=value.lastIndexOf(".");
  if (apos<1||dotpos-apos<2)
    {alert(alerttxt);return false;}
  else {return true;}
  }
}

function validate_form(thisform)
{
with (thisform)
  {
  if (validate_email(email,"Oops! Please provide your email address.")==false)
    {email.focus();return false;}
  }
}
</script>
<!-- end client-side form validation -->

<!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-10336346-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<!-- end Google Analytics -->

</body>
</html>
