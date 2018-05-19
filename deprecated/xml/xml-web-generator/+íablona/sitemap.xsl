<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:a="http://www.w3.org/2005/Atom"
	xmlns:j="java:cz.frantovo.xmlWebGenerator.Funkce"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:fn="http://www.w3.org/2005/xpath-functions"
	exclude-result-prefixes="fn j a">
	<xsl:output	method="xml" indent="yes" encoding="UTF-8"/>
	
	<xsl:template match="/">
		<urlset>
			<xsl:apply-templates select="a:feed/a:entry"/>
		</urlset>
	</xsl:template>
	
	<xsl:template match="a:entry">
		<url>
			<loc><xsl:value-of select="a:link/@href"/></loc>
			<lastmod><xsl:value-of select="a:updated"/></lastmod>
		</url>
	</xsl:template>
	
</xsl:stylesheet>
