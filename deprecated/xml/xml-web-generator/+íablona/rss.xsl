<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
	xmlns:a="http://www.w3.org/2005/Atom"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:j="java:cz.frantovo.xmlWebGenerator.Funkce"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:fn="http://www.w3.org/2005/xpath-functions"
	exclude-result-prefixes="fn j a">
	<xsl:output	method="xml" indent="yes" encoding="UTF-8"/>
	
	<xsl:template match="/">		
		<rss version="2.0">
			<channel>
				<xsl:variable name="url" select="a:feed/a:link[not(@rel)]/@href"/>
				<title><xsl:value-of select="a:feed/a:title"/></title>
				<link><xsl:value-of select="$url"/></link>
				<description><xsl:value-of select="a:feed/a:subtitle"/></description>				
				<atom:link rel="self" href="{$url}rss.xml"/>
				<xsl:apply-templates select="a:feed/a:entry"/>
			</channel>
		</rss>		
	</xsl:template>
	
	<xsl:template match="a:entry">
		<item>		
			<title><xsl:value-of select="a:title"/></title>
			<link><xsl:value-of select="a:link/@href"/></link>
			<description><xsl:value-of select="a:summary"/></description>
			<guid><xsl:value-of select="a:id"/></guid>
			<pubDate><xsl:value-of select="format-dateTime(a:updated,
                '[FNn,*-3], [D01] [MNn,*-3] [Y0001] [H01]:[m01]:[s01] [Z]',
                'en',
                'ISO',
                'US')"/></pubDate>		
		</item>
	</xsl:template>
	
</xsl:stylesheet>
