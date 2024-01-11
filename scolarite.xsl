<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.1"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:php="http://php.net/xsl">
    <xsl:template match="/">
        <html>
            <head>
                <title>Liste des enseignants</title>
            </head>
            <body>
                <h1>
                    liste of candidates
                </h1>
                <table>
                  <tr>
                    <th> ID_Candidat</th>
                    <th>cin</th>
                    <th>cne</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>email</th>
                    <th>password</th>
                    <th>telephone</th>
                    <th>DateNaissance</th>
                    <th>ID_Diplome</th>
                </tr>
                 <xsl:for-each select="Candidats/Candidat">
                        <tr>
                            <td>
                                <xsl:value-of select="@ID_Candidat" />
                            </td>
                            <td>
                                <xsl:value-of select="cin" />
                            </td>
                            <td>
                                <xsl:value-of select="cne" />
                            </td>
                            <td>
                                <xsl:value-of select="Nom" />
                            </td>
                            <td>
                                <xsl:value-of select="Prenom" />
                            </td>                           
                            <td>
                                <xsl:value-of select="email" />
                            </td>              
                            <td>
                                <xsl:value-of select="password" />
                            </td>
                           <td>
                                <xsl:value-of select="telephone" />
                            </td>                            
                            <td>
                                <xsl:value-of select="DateNaissance" />
                            </td>                            
                            <td>
                                <xsl:value-of select="ID_Diplome" />
                            </td>
                        </tr>
                    </xsl:for-each>
                </table>
        
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>