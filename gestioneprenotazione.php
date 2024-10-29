<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $tavolo = $_POST["tavolo"];
        $orario = $_POST["orario"];
        $note = $_POST["note"];

        $antipasto = isset($_POST["antipasto"]);
        $primo = isset($_POST["primo"]);
        $secondo = isset($_POST["secondo"]);
        $parcheggio = $_POST["parcheggio"];

        $camerieri = array("Mario", "Luigi", "Giovanni", "Francesco", "Andrea");
        $cameriere = $camerieri[rand(0, 4)];

        $prezzoAntipasto = 5;
        $prezzoPrimo = 6;
        $prezzoSecondo = 7;

        if (!$antipasto && !$primo && !$secondo) {   //SE NESSUNO E' SELEZIONATO
            echo "<h1>Errore nella Prenotazione</h1>";
            echo "<p>Devi selezionare almeno un pasto</p>";
            echo "<p>Data e ora: " . date("d-m-Y H:i") . "</p>";
            echo "<a href='prenotazione.html'>Torna alla pagina di prenotazione</a>";
            exit;  //ESCE DAL CODICE E LO FA TERMINARE
        }

        if ($antipasto && !$primo && !$secondo) {   //SE SOLO L'ANTIPASTO E' SELEZIONATO
            echo "<h1>Errore nella Prenotazione</h1>";
            echo "<p>Non è possibile ordinare solo l'antipasto.</p>";
            echo "<p>Data e ora: " . date("d-m-Y H:i") . "</p>";
            echo "<a href='prenotazione.html'>Torna alla pagina di prenotazione</a>";
            exit;
        }


        //PREZZI
        $prezzoTotale = 0;

        if ($antipasto) {
            $prezzoTotale = $prezzoTotale + $prezzoAntipasto;
        }

        if ($primo) {
            $prezzoTotale = $prezzoTotale + $prezzoPrimo;
        }

        if ($secondo) {
            $prezzoTotale = $prezzoTotale + $prezzoSecondo;
        }


        //SCONTI
        if ($primo && $secondo) {
            $prezzoTotale = $prezzoTotale - ($prezzoTotale * 0.1); //SCONTO 10%
        } elseif ($antipasto && $primo && $secondo) {
          $prezzoTotale = $prezzoTotale - ($prezzoTotale * 0.15); //SCONTO 15%
        }

        
        //PREZZI PARCHEGGIO
        if ($parcheggio == "non custodito") {
            $prezzoTotale = $prezzoTotale + 3;
        } elseif ($parcheggio == "custodito") {
          $prezzoTotale = $prezzoTotale + 5;
        }


        
        echo "<h1>Resoconto Prenotazione</h1>";
        echo "<table border='1'>";
        echo "<tr><td>Nome:</td><td>$nome</td></tr>";
        echo "<tr><td>Cognome:</td><td>$cognome</td></tr>";
        echo "<tr><td>Tavolo:</td><td>$tavolo</td></tr>";
        echo "<tr><td>Orario:</td><td>$orario</td></tr>";
        echo "<tr><td>Note:</td><td>$note</td></tr>";
        echo "<tr><td>Antipasto:</td><td>" . ($antipasto ? "Si" : "No") . "</td></tr>";
        echo "<tr><td>Primo:</td><td>" . ($primo ? "Si" : "No") . "</td></tr>";
        echo "<tr><td>Secondo:</td><td>" . ($secondo ? "Si" : "No") . "</td></tr>";
        echo "<tr><td>Parcheggio:</td><td>$parcheggio</td></tr>";
        echo "<tr><td>Prezzo Totale:</td><td>" . number_format($prezzoTotale, 2) . " €</td></tr>";
        echo "<tr><td>Cameriere:</td><td>$cameriere</td></tr>";
        echo "<tr><td>Data e ora:</td><td>" . date("d-m-Y H:i") . "</td></tr>";
        echo "</table>";


    ?>
</body>
</html>
