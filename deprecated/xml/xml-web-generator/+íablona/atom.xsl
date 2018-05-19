<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
	xmlns="http://www.w3.org/2005/Atom"
	xmlns:s="https://trac.frantovo.cz/xml-web-generator/wiki/xmlns/strana"
	xmlns:k="https://trac.frantovo.cz/xml-web-generator/wiki/xmlns/konfigurace"
	xmlns:j="java:cz.frantovo.xmlWebGenerator.Funkce"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:fn="http://www.w3.org/2005/xpath-functions"
	exclude-result-prefixes="fn s k j">
	<xsl:output	method="xml" indent="yes" encoding="UTF-8"/>
	
	<xsl:param name="vstupníPřípona" select="'.xml'"/>
	<xsl:param name="výstupníPřípona" select="'.xhtml'"/>
	
	<xsl:template match="/">		
	
		<feed>
			<title><xsl:value-of select="k:web/k:název"/></title>
			<subtitle><xsl:value-of select="k:web/k:podtitul"/></subtitle>
			<link rel="self" href="{concat(k:web/k:url, 'atom.xml')}"/>
			<link href="{k:web/k:url}"/>			
			<updated><xsl:value-of select="current-dateTime()"/></updated>			
			<author>
				<name><xsl:value-of select="k:web/k:autor/k:jméno"/></name>
				<email><xsl:value-of select="k:web/k:autor/k:email"/></email>
			</author>
			<id><xsl:value-of select="concat('urn:uuid:', k:web/k:uuid)"/></id>
			
			<xsl:variable name="konfigurace" select="/"/>
			<xsl:for-each select="collection(concat('../vstup/?select=*', $vstupníPřípona))[empty(s:stránka/s:skrytá) or not(s:stránka/s:skrytá)]">
				<entry>
					<title><xsl:value-of select="s:stránka/s:nadpis"/></title>
					<xsl:variable name="soubor" select="replace(tokenize(document-uri(.), '/')[last()], $vstupníPřípona, '')"/>
					<link href="{concat($konfigurace/k:web/k:url, encode-for-uri($soubor), $výstupníPřípona)}" />
					<id><xsl:value-of select="concat('urn:', $konfigurace/k:web/k:kod ,':strana:', encode-for-uri($soubor))"/></id>					
					<updated><xsl:value-of select="j:posledníZměna(document-uri(.))"/></updated>
					<summary><xsl:value-of select="s:stránka/s:perex"/></summary>
				</entry>
			</xsl:for-each>
			
		</feed>
	</xsl:template>
	
</xsl:stylesheet>
