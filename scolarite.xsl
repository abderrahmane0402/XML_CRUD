<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.1"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:php="http://php.net/xsl">
    <xsl:param name="hello" />
    <xsl:template match="/">
        <html>
            <head>
                <title>Liste des enseignants</title>
            </head>
            <body>
                <h1>
                    <xsl:value-of select="$hello" />
                </h1>
                <h1>Details des modules</h1>
                <xsl:for-each select="Modules/module"> </xsl:for-each>
                <form action="test.php" method="post">
                    <input name="text" type="text" />
                    <input type="submit" />
                </form>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>