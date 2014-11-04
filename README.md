<h1>AFASintegration</h1>

This PHP class file enables you to quickly make an integration page with an AFAS InSite intranet website. By calling the PHP class and including the public and private key of the integration page, you can retrieve information about the user's session in the AFAS InSite website.

<h2>Usage</h2>
Use the following PHP source code to call and activate the PHP class.
```HTML+PHP
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
```
After you have successfully called the PHP class including a valid public and private key combination, use the variable and code below to use the retrieved session information.
```HTML+PHP
<?php var_dump($AFASintegration->data)?>
```
