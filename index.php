<?php
//importnak a helye
    include_once "Adatbazis.php";
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stilus.css">
    <title>Magyar kártya</title>
</head>
<body>
    <?php
        $adatbazis = new Adatbazis();
        //megjelenítjük a szín tábla képeit
        $eredmeny = $adatbazis->adatLeker("kep", "szin");
        //mátrix bejárása, egydimezniós mátrix
        $adatbazis->megvalosit($eredmeny);
        echo '<br>';
        $eredmeny = $adatbazis->adatLeker2("ertek", "szoveg", "forma");
        $adatbazis->megvalositAsszoc($eredmeny, "ertek", "szoveg");
        $adatbazis->kartyaFeltolt($tabla);
        $adatbazis->kapcsolatBezar();
    ?>
</body>
</html>