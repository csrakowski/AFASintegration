<h1>AFAS InSite integration page class</h1>

This C# class file enables you to quickly make an integration page with an AFAS InSite intranet website. By calling the C# class and including the public and private key of the integration page, you can retrieve information about the user's session in the AFAS InSite website.

<h2>Creating a new integration page</h2>
<p>Follow the hyperlinks below in order to create the new integration page in AFAS Profit:</p>
<ul>
<li><strong>English</strong><br /><a href="https://kb.afas.nl/index.php/details/kb/product:se//?0100000061569020129720160202" title="Add an integration page in InSite and OutSite">Add an integration page in InSite and OutSite</a></li>
<li><strong>Dutch</strong><br /><a href="https://kb.afas.nl/index.php/details/kb/product:se//?0100000061569010129720160202" title="Integratiepagina toevoegen in InSite en OutSite">Integratiepagina toevoegen in InSite en OutSite</a></li>
<li><strong>French</strong><br /><a href="https://kb.afas.nl/index.php/details/kb/product:se//?0100000061569030129720160202" title="Ajouter une page d'intégration dans InSite et OutSite">Ajouter une page d'intégration dans InSite et OutSite</a></li>
</ul>

<h2>Technical documentation</h2>
<p>The AFAS KnowledgeBase includes detailed documentation on how to integrate external pages through an iFrame with AFAS InSite:</p>
<a href="http://profitdownload.afas.nl/download/help_docs/Partner_documentatie_integratie-pagina's_InSite_en_OutSite.pdf" title="Externe pagina's integreren in InSite en OutSite">Externe pagina's integreren in InSite en OutSite</a>

<h2>Usage</h2>
Use the following C# source code to call and activate the class.

```csharp
var config = new AFASConfig
{
	PublicKey = "YOUR_PUBLIC_KEY_HERE",
	PrivateKey = "YOUR_PRIVATE_KEY_HERE",
	ValidateSsl = false,
	Debug = true
};

var integration = new AFASIntegration(config);

var response = await integration.ProcessRequestAsync(request);
```

After you have successfully called the class including a valid public and private key combination, use the properties on the reponse object to read the retrieved session information.


...TODO...
