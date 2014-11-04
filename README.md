<h1>AFASintegration</h1>

This PHP class file enables you to quickly make an integration page with an AFAS InSite intranet website. By calling the PHP class and including the public and private key of the integration page, you can retrieve information about the user's session in the AFAS InSite website.

<h2>Creating a new integration page</h2>
<p>Follow the hyperlinks below in order to create the new integration page in AFAS Profit:</p>
<ul>
<li><strong>English</strong><br /><a href="https://static-kb.afas.nl/datafiles/help/2_9_5/SE/EN/index.htm#Ins_Config_Site_iFrame_1.htm" title="Configure the display of external content in an iFrame in InSite and OutSite">Configure the display of external content in an iFrame in InSite and OutSite</a></li>
<li><strong>Dutch</strong><br /><a href="https://static-kb.afas.nl/datafiles/help/2_9_5/SE/NL/index.htm#Ins_Config_Site_iFrame_1.htm" title="Externe content in InSite en OutSite tonen in een iFrame inrichten">Externe content in InSite en OutSite tonen in een iFrame inrichten</a></li>
<li><strong>French</strong><br /><a href="https://static-kb.afas.nl/datafiles/help/2_9_5/SE/FR/index.htm#Ins_Config_Site_iFrame_1.htm" title="Configuration de l'affichage du contenu externe InSite et OutSite dans iFrame">Configuration de l'affichage du contenu externe InSite et OutSite dans iFrame</a></li>
</ul>

<h2>Technical documentation</h2>
<p>The AFAS KnowledgeBase includes detailed documentation on how to integrate external pages through an iFrame with AFAS InSite:</p>
<a href="http://profitdownload.afas.nl/download/help_docs/Partner_documentatie_integratie-pagina's_InSite_en_OutSite.pdf" title="Technical documentation AFAS InSite integration page">http://profitdownload.afas.nl/download/help_docs/Partner_documentatie_integratie-pagina's_InSite_en_OutSite.pdf</a>

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

<h2>Variables</h2>
<h3>PHP source</h3>
<ul>
	<li><strong>public_key</strong><br>The public key has been
		provided by AFAS Profit and allows you to know which integration
		page has requested your script.</li>
	<li><strong>private_key</strong><br>The private key has been
		provided by AFAS Profit and allows you to verify that you are
		allowed to use the integration.</li>
	<li><strong>validate_ssl</strong><br>Whether or not you wish to
		validate the SSL certificate of the InSite URL.</li>
	<li><strong>debug</strong><br>Whether or not you wish to include
		performance indicators in the data variable of the PHP class.</li>
</ul>
<h3>Request</h3>
<ul>
	<li><strong>dataurl</strong><br>Alternate url to be used for an
		integration without public and private keys.</li>
	<li><strong>tokenurl</strong><br>The url to which we will be
		making a postback to confirm the originating InSite page that we
		have a valid private key in order to receive the integrated
		details.</li>
	<li><strong>code</strong><br>The originating InSite expects this
		unique code in the postback for verification and identification
		purposes.</li>
	<li><strong>publickey</strong><br>The public key has been
		provided by AFAS Profit and allows you to know which integration
		page has requested your script.</li>
	<li><strong>sessionid</strong><br>This session id originates from
		the actual InSite session of the user, and allows you to make sure
		that you are still dealing with the same InSite user throughout
		requests.</li>
</ul>
<h3>Result</h3>
<ul>
	<li><strong>environmentId</strong><br>The identifier of the AFAS
		Profit environment in which the InSite is hosted.</li>
	<li><strong>sessionId</strong><br>This session id originates from
		the actual InSite session of the user, and allows you to make sure
		that you are still dealing with the same InSite user throughout
		requests.</li>
	<li><strong>userId</strong><br>The username of the user which is
		logged in at InSite.</li>
	<li><strong>personCode</strong><br>The code of the registered
		person in AFAS Profit.</li>
	<li><strong>contactId</strong><br>The code of the registered
		contact in AFAS Profit.</li>
	<li><strong>organizationCode</strong><br>The code of the
		registered organization in AFAS Profit.</li>
	<li><strong>employeeId</strong><br>The code of the registered
		employee in AFAS Profit.</li>
	<li><strong>cssUrl</strong><br>Use the CSS-resource at this
		address to give your integrated page the same appearance as the
		originating InSite website.</li>
	<li><strong>scriptUrl</strong><br>Use the JavaScript-resource at
		this address to provide a complete integrated experience and allow
		for sizing-functionality.</li>
</ul>
