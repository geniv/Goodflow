<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:h="http://www.w3.org/1999/xhtml"
	xmlns:s="https://trac.frantovo.cz/xml-web-generator/wiki/xmlns/strana"
	xmlns:k="https://trac.frantovo.cz/xml-web-generator/wiki/xmlns/konfigurace"
	xmlns:m="https://trac.frantovo.cz/xml-web-generator/wiki/xmlns/makro"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:fn="http://www.w3.org/2005/xpath-functions"
	xmlns:svg="http://www.w3.org/2000/svg"
	xmlns:xs="http://www.w3.org/2001/XMLSchema"
	exclude-result-prefixes="fn h s k m xs">
	<xsl:output 
		method="xml" 
		indent="yes" 
		encoding="UTF-8"		
		doctype-public="-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN" 
		doctype-system="http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg.dtd"/>
		
	<xsl:param name="vstup" select="'../vstup/'"/>
	<xsl:param name="vstupníPřípona" select="'.xml'"/>
	<xsl:param name="výstupníPřípona" select="'.xhtml'"/>
	<xsl:param name="vsuvkováPřípona" select="'.inc'"/>
	<xsl:param name="podporaZaostalýchProhlížečů" select="false()" as="xs:boolean"/>
	
	<xsl:include href="makra.xsl"/>
	
	<!-- Celý dokument: -->
	<xsl:template match="/">
		<xsl:variable name="konfigurace" select="document(concat($vstup, 'web.conf'))"/>
		<html>
			<head>
				<xsl:if test="$podporaZaostalýchProhlížečů">
					<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
				</xsl:if>
				<title><xsl:value-of select="s:stránka/s:nadpis"/></title>
				<link title="Novinky (Atom)" href="atom.xml" type="application/atom+xml" rel="alternate"/>
				<link title="Novinky (RSS)"  href="rss.xml"  type="application/rss+xml"  rel="alternate"/>
				<xsl:apply-templates select="$konfigurace/k:web/k:js"/>
				<xsl:apply-templates select="$konfigurace/k:web/k:css"/>				
			</head>
			<body>
				<div id="tělo">
					<div id="záhlaví">
						<xsl:apply-templates select="document(fn:encode-for-uri(concat($vstup, 'záhlaví', $vsuvkováPřípona)))/s:stránka/h:text/node()"/>
					</div>
					<div id="vnitřek">
						<h1><xsl:value-of select="s:stránka/s:nadpis"/></h1>
						<ul id="nabídka">
							<xsl:for-each select="collection(concat('../vstup/?select=*', $vstupníPřípona))[s:stránka/s:pořadí]">
								<xsl:sort select="empty(./s:stránka/s:pořadí)"/>
								<xsl:sort select="./s:stránka/s:pořadí"/>
								<li>
									<xsl:variable name="xmlSoubor" select="tokenize(document-uri(.), '/')[last()]"/>
									<xsl:variable name="xhtmlSoubor" select="replace($xmlSoubor, $vstupníPřípona, $výstupníPřípona)"/>
									<a href="{fn:encode-for-uri($xhtmlSoubor)}"><xsl:value-of select="./s:stránka/s:nadpis"/></a>
								</li>
							</xsl:for-each>
						</ul>
						<div id="text">
							<xsl:apply-templates select="s:stránka/h:text/node()"/>
						</div>
					</div>
					<div id="zápatí">
						<xsl:apply-templates select="document(fn:encode-for-uri(concat($vstup, 'zápatí', $vsuvkováPřípona)))/s:stránka/h:text/node()"/>
					</div>
				</div>
			</body>
		</html>
	</xsl:template>
	
	<!-- Kopírujeme elementy, ale vynecháme nepoužité xmlns deklarace: -->
	<xsl:template match="*">
		<xsl:element name="{name()}">
			<xsl:copy-of select="@*"/>
			<xsl:apply-templates/>
		</xsl:element>
    </xsl:template>
    
    <!-- Varování pro případ, že jsme v režimu podpory pro zaostalé prohlížeče -->
    <xsl:template name="varováníRetardace">
    	<xsl:if test="$podporaZaostalýchProhlížečů">
			<xsl:comment>
				Generátor byl spuštěn v režimu podpory zaostalých prohlížečů.
				Uživatelům doporučujeme upgrade na skutečný WWW prohlížeč,
				jako je např. Firefox nebo Chromium (případně Opera či Safari).
			</xsl:comment>
    	</xsl:if>
    </xsl:template>

    <!-- Odkazy na JavaScript a kaskádové styly -->    
    <xsl:template match="k:web/k:js">    	
    	<script src="{text()}" type="text/javascript">
    		<xsl:call-template name="varováníRetardace"/>
    	</script>
    </xsl:template>
    <xsl:template match="k:web/k:css">
    	<link href="{text()}" type="text/css" rel="StyleSheet" />
    </xsl:template>
   
    <!--
    	Makro pro převod interních odkazů:
    		- doplnění správné přípony
    		- URL kódování znaků
    -->
    <xsl:template match="m:a">
    	<a>
    		<xsl:copy-of select="@*"/>
    		<xsl:attribute name="href">
    			<xsl:value-of select="fn:encode-for-uri(concat(@href, $výstupníPřípona))"/>
    		</xsl:attribute>
    		<xsl:apply-templates/>
    	</a>
    </xsl:template>

</xsl:stylesheet>
