Web Application Assessment Report Management Platform

The Web Application Assessment Report Management Platform application is a web application report engine used to generate HTML, CSV, and PDF reports from raw XML files that are generated from the WebInspect web application scanner.  

WebInpsect is a web application vulnerability scanner that produces a XML output. The XML output is a list of vulnerabilities and the details associated to remediate each respective vulnerability.

I developed this project to be used by our users at Xerox Corp.  Our users needed a easy way to view the vulnerabilities in multiple formats.  The current report engine is very basic and only produces a list in PDF which is not very intuitive.

To use the tool, the user (which is only an admin), will be able to upload the report.  The Web Application Assessment Report Management Platform will process the report, take some stats and create an entry into the DB.   Once the report is processed, the admin us is able to share the report link to the general public via the “Request Closure Notice link.”  The report link give the anonymous user the ability to generate multiple formats (Print - HTML non-interactive, PDF, or CSV.)

There are two sample reports that can be used to demonstrate this concepts:

- Report 1 - 
- Report 2 - 

/// - Feature List - ///

	- Upload Report using dynamic HTML file upload
	- Process raw XML output and gather stats
	- Dynamically generates HTML, Non-Interactive HTML, PDF, and CSV output from a raw XML. 
	- Dynamic statistics of how many reports have been generated in the last 6 months using google charts
	- JSON (JQuery) Dynamic Search Engine.  Users are able to search the database while looking for a specific request number.
	- Users need to activated - only admin can activate a users.  The data in the system is confidential.


/// - Test Admin Credentials - ///

Username: claudiu.rusnac@xerox.com
Password: SecureMe!


/// - Credits - ///

- Upload Feature: 
	Remy Sharp - http://html5demos.com/dnd-upload

- Design:
	- Bootstrap - http://getbootstrap.com
	- Bootstrap Themes - http://bootswatch.com/yeti/ 
	- Start Bootstrap - http://startbootstrap.com 'SB Admin' HTML Template by Start Bootstrap
	- FontAwesome - http://fontawesome.io
	- Charts - https://developers.google.com/chart/
	