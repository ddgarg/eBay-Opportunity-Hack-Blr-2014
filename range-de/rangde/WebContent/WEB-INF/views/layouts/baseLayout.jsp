<?xml version="1.0" encoding="utf-8"?>
<%@ taglib uri="http://tiles.apache.org/tags-tiles" prefix="tiles" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>
        </title>
        <tiles:insertAttribute name="meta" ignore="true" />
		<s:head />

    </head>
    <body>
    <!-- Header Starts -->
	<tiles:insertAttribute name="header" />
	<!-- Header Ends -->
	<!-- Menu starts -->
	<tiles:insertAttribute name="menu" />
	<!-- Menu Ends -->
	<!-- Body content starts -->
    <tiles:insertAttribute name="body" />
    <!-- Body content ends -->
    <!-- Footer Starts -->
	<tiles:insertAttribute name="footer" />
    <!-- Footer ends -->       
    <!--  Commenting Body and html tags as they are in footer.html </body></html> -->
