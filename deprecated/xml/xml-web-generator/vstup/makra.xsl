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
    
    <!-- Ukázka vlastního „makra“: -->
    <xsl:template match="m:měřák">
    	<xsl:variable name="hodnota" select="number(@hodnota)"/>
    	<xsl:variable name="šířkaGrafu" select="128"/>
		<xsl:choose>			
			<xsl:when test="$hodnota &gt;= 0 and $hodnota &lt;= 100">				
				<div style="border: 1px solid black; width: {$šířkaGrafu}px; height: 16px; padding: 0px; text-align: center; background-color: #cfc;">			
					<div style="margin: 0px; background-color: #A4E666; width: {@hodnota*$šířkaGrafu div 100}px; height: 16px;"><xsl:call-template name="varováníRetardace"/></div>
					<p style="margin: 0px; font-size: 12px; position: relative; top: -15px;">
						<xsl:value-of select="@hodnota"/>/100
					</p>	
				</div>
			</xsl:when>
			<xsl:otherwise>
				<xsl:message terminate="yes">Hodnota měřáku musí být nejméně 0 a nejvíce 100 (udává procenta).</xsl:message>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>

</xsl:stylesheet>