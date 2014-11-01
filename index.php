<?php
// Include the PHP class file
include_once ('class.afasintegration.php');
// Prepare the configuration variable
$config = array (
		'public_key' => 'YOUR_PUBLIC_KEY_HERE',
		'private_key' => 'YOUR_PRIVATE_KEY_HERE',
		'validate_ssl' => false,
		'debug' => true 
);
// Instantiate the PHP class file
$AFASintegration = new AFASintegration ( $_REQUEST, $config );
?>
<!DOCTYPE html>
<html lang="en">

<head>

<title>AFAS InSite Integration page</title>
<meta name="robots" content="noindex, nofollow" />
<link type="image/x-icon" href="favicon.ico" rel="icon" />
<link type="image/x-icon" href="favicon.ico" rel="shortcut icon" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link
	href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"
	rel="stylesheet" />
<?php if (isset($AFASintegration->data['data']['cssUrl'])):?>
<link href="<?php echo $AFASintegration->data['data']['cssUrl']?>"
	rel="stylesheet" />
<?php endif?>


<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script
	src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<?php if (isset($AFASintegration->data['data']['scriptUrl'])):?>
<script src="<?php echo $AFASintegration->data['data']['scriptUrl']?>"></script>
<?php endif?>

<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


</head>

<body>


	<div class="container-fluid">

		<div class="AfasPageTitleContainer">
			<h1 class="AfasPageTitle">AFASintegration</h1>
		</div>

		<div class="AfasPageIntroContainer">
			<p class="AfasPageIntro">
				This page demonstrates the integration between AFAS InSite and your
				PHP installation. In the source of this PHP file <em>index.php</em>
				you can experience the ease of the integration with the PHP class
				file <em>class.afasintegration.php</em>.
			</p>
		</div>

		<h2 class="AfasParagraphHeader1">PHP source</h2>
		<div class="row">
			<div class="col-md-3">
				<p>The code on the right is the only source could you will need to
					make the integration possible. These are your configuration
					parameters:</p>
				<ul>
					<li><strong>public_key</strong><br />The public key has been
						provided by AFAS Profit and allows you to know which integration
						page has requested your script.</li>
					<li><strong>private_key</strong><br />The private key has been
						provided by AFAS Profit and allows you to verify that you are
						allowed to use the integration.</li>
					<li><strong>validate_ssl</strong><br />Whether or not you wish to
						validate the SSL certificate of the InSite URL.</li>
					<li><strong>debug</strong><br />Whether or not you wish to include
						performance indicators in the data variable of the PHP class.</li>
				</ul>
			</div>
			<div class="col-md-9">
				<pre>
&lt;?php
include_once ('class.afasintegration.php');
$config = array (
	'public_key' => 'YOUR_PUBLIC_KEY_HERE',
	'private_key' => 'YOUR_PRIVATE_KEY_HERE',
	'validate_ssl' => false,
	'debug' => true 
);
$AFASintegration = new AFASintegration ( $_REQUEST, $config );
?></pre>
			</div>
		</div>

		<h2 class="AfasParagraphHeader1">Request</h2>
		<div class="row">
			<div class="col-md-3">
				<p>The data contained in this block represents the initial request
					that was sent by the originating AFAS InSite to your integration
					page. This is what the different parameters mean:</p>
				<ul>
					<li><strong>dataurl</strong><br />Alternate url to be used for an
						integration without public and private keys.</li>
					<li><strong>tokenurl</strong><br />The url to which we will be
						making a postback to confirm the originating InSite page that we
						have a valid private key in order to receive the integrated
						details.</li>
					<li><strong>code</strong><br />The originating InSite expects this
						unique code in the postback for verification and identification
						purposes.</li>
					<li><strong>publickey</strong><br />The public key has been
						provided by AFAS Profit and allows you to know which integration
						page has requested your script.</li>
					<li><strong>sessionid</strong><br />This session id originates from
						the actual InSite session of the user, and allows you to make sure
						that you are still dealing with the same InSite user throughout
						requests.</li>
				</ul>
			</div>
			<div class="col-md-9">
				<pre><?php var_dump($_REQUEST)?></pre>
			</div>
		</div>

		<h2 class="AfasParagraphHeader1">Result</h2>
		<div class="row">
			<div class="col-md-3">
				<p>The result we show here contains the response given by the
					originating AFAS InSite integration page after the postback has
					been sent after the initial trigger request above.</p>
				<ul>
					<li><strong>environmentId</strong><br />The identifier of the AFAS
						Profit environment in which the InSite is hosted.</li>
					<li><strong>sessionId</strong><br />This session id originates from
						the actual InSite session of the user, and allows you to make sure
						that you are still dealing with the same InSite user throughout
						requests.</li>
					<li><strong>userId</strong><br />The username of the user which is
						logged in at InSite.</li>
					<li><strong>personCode</strong><br />The code of the registered
						person in AFAS Profit.</li>
					<li><strong>contactId</strong><br />The code of the registered
						contact in AFAS Profit.</li>
					<li><strong>organizationCode</strong><br />The code of the
						registered organization in AFAS Profit.</li>
					<li><strong>employeeId</strong><br />The code of the registered
						employee in AFAS Profit.</li>
					<li><strong>cssUrl</strong><br />Use the CSS-resource at this
						address to give your integrated page the same appearance as the
						originating InSite website.</li>
					<li><strong>scriptUrl</strong><br />Use the JavaScript-resource at
						this address to provide a complete integrated experience and allow
						for sizing-functionality.</li>
				</ul>
			</div>
			<div class="col-md-9">
				<pre><?php var_dump($AFASintegration->data)?></pre>
			</div>
		</div>
	</div>

</body>

</html>