$dbHost = "localhost";
$dbName = "login-system";
$dbUser = "root";
$dbPass = "";

/*   misschien is de try catch block nieuw voor jullie
 *   de try catch block probeert om de code in de try scope uit te voeren.
 *   lukt dat niet, dan wordt de code uitgevoerd die in de catch scope staat.
 *   Op deze manier heb je zelf wat beter in de hand wat er moet gebeuren als
 *   er iets in je applicatie fout gaat.
*/

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<div class='note' style='background: #fedde9; padding: 10px; margin: 10px; font-family: courier'>
            <h4>OEI!</h4>
            Welkom op het oefen project voor het maken van een login- en registreersysteem.
            Zoals je wellicht zult zien zie je hieronder een foutmelding... 
            Voordat je deze voorbeeld applicatie kunt gebruiken zul je een aantal dingen moeten doen:
            <ol>    
                <li>Mysql server starten</li>
                <li>Tabel daarin aanmaken met de benodigde velden</li>
            </ol>
            
            Je zult in deze applicatie de belangrijkste dingen zelf moeten coden. De projectopzet is exact hetzelfde
            hoe je het tijdens de lessen hebt geleerd. Er is ook binnen de code genoeg commentaar voorzien om je verder
            te helpen met het afmaken van deze demo- applicatie.
         </div>";
    die($e->getMessage());
}

session_start();