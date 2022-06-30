Ajax-Zoom PHP component can run efficiently on ASP.NET 4.0+ as a native fully managed 64-bit .NET application, 
as a part of ASP.NET web site. This is achieved thanks to Phalanger PHP compiler. 

You do not need to install PHP on your Server!
If you do habve native PHP along with needed PHP extensions installed on IIS, 
please remove Bin directory and web.config file of the package!

Requirements (without PHP installed):
IIS 7 (or later) with ASP.NET 4.0+ Web Site configured or Visual Studio 2010+ for development.

The basic installation is fairly easy:

1.	Extract the download package somewhere into ASP.NET site.
 
2.	Ensure folders \pic\{cache|temp|zoomthumb|zoomgallery|zoomtiles|zoommap|zoomtiles_80|*} are writable

3.	Merge provided "web.config" into your "web.config"

4.	Ensure Bin/Dynamic is writable for your IIS user account

5.	Example project: You can extract the archive into the root of your ASP.NET server, 
	or open it as an existing web site from Visual Studio 2010 from any location 
	(note you might habe to set empty "Virtual Path" in "Properties" of the web site).

6.	If you experince any troubles in /axZm/zoomConfig.inc.php  try to adjust these variables manually: 
	$zoom['config']['fpPP']
	$zoom['config']['installPath']
        $zoom['config']['urlPath']
        $zoom['config']['rewriteBase']

        e.g. $zoom['config']['urlPath'] = '//localhost:3990';
        or whatever port you are using...
