<?php

// Load the XML document
$xml = new DOMDocument();
$xml->load('DataBase.xml');

// Load the XSLT stylesheet
$xsl = new DOMDocument();
$xsl->load('scolarite.xsl');

// Create the XSLTProcessor object
$xsltProcessor = new XSLTProcessor();

// Load the XSLT stylesheet into the XSLTProcessor object
$xsltProcessor->importStylesheet($xsl);

$xsltProcessor->setParameter('', "hello", "world");

// Apply the XSLT transformation to the XML document
$html = $xsltProcessor->transformToXML($xml);

// Output the transformed HTML
echo $html;

?>