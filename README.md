<h1>Web Application Assessment Report Management Platform</h1>

The Web Application Assessment Report Management Platform application is a web application report engine used to generate HTML, CSV, and PDF reports from raw XML files that are generated from the <a href="http://www8.hp.com/us/en/software-solutions/software.html?compURI=1341991#.UrSh6XnWJpc">HP WebInspect web application scanner</a>.  

HP WebInpsect is a web application vulnerability scanner that produces a XML output. The XML output is a list of vulnerabilities and the details associated to remediate each respective vulnerability.

I developed this project to be used by our users at Xerox Corp.  Our users needed a easy way to view the vulnerabilities in multiple formats.  The current report engine is very basic and only produces a list in PDF which is not very intuitive.

To use the Web Application Assessment Report Management Platform, the user (admin only), will be able to upload the raw XML output.  The Web Application Assessment Report Management Platform will process the raw XML output, take some stats and create an entry into the DB.   Once the raw XML output is processed, the admin is able to share a report link to the general public via the “Request Closure Notice link.”  The report link give anonymous users the ability to dynamically view/generate multiple formats (Print - HTML non-interactive, PDF, or CSV) of the report.

There are two sample reports that can be used to demonstrate this concepts:

<ul>
<li>sample-reports/1002.xml
<li>sample-reports/1003.xml
</ul>

<h2>Feature List</h2>
<ul>
<li>Upload Report using dynamic HTML file upload
<li>Process raw XML output and gather stats
<li>Dynamically generates HTML, Non-Interactive HTML, PDF, and CSV output from a raw XML. 
<li>Dynamic statistics of how many reports have been generated in the last 6 months using google charts
<li>JSON (JQuery) Dynamic Search Engine.  Users are able to search the database while looking for a specific request number.
<li>Users need to activated - only admin can activate a users.  The data in the system is confidential.
</ul>

<h3>Test Admin Credentials</h3>
<ul>
<li><strong>Username:</strong> system.admin@do-not-reply.com
<li><strong>Password:</strong> SecureMe!
</ul>

<h3>Credits</h3>

<strong>Upload Feature:</strong> Remy Sharp - http://html5demos.com/dnd-upload

<strong>Design:</strong>
<ul>
<li>Bootstrap - http://getbootstrap.com
<li>Bootstrap Themes - http://bootswatch.com/yeti/ 
<li>Start Bootstrap - http://startbootstrap.com 'SB Admin' HTML Template by Start Bootstrap
<li>FontAwesome - http://fontawesome.io
<li>Charts - https://developers.google.com/chart/
</ul>

<h4>Project Notes</h4>
<ul>

<li>On generated report HTML/PDF pages, there are some internal styling and javascript to aide in the chart creation and support styling of specific elements when the user downloads a specific report.  This was done intentionally. 

</ul>