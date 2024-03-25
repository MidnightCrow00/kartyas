<?php
class Adatbazis
{
    private $host = "localhost";
    private $felhasznaloNev = "root";
    private $jelszo  =  "";
    private $adatbazisNev = "mkartya";
    private $kapcsolat;

    //kontstruktor
    public function __construct()
    {
        //kapcsolat beállítása
        $this->kapcsolat = new mysqli(
            $this->host,
            $this->felhasznaloNev,
            $this->jelszo,
            $this->adatbazisNev
        );
        $szoveg = "";
        if ($this->kapcsolat->connect_error)
            $szoveg = "Sikertelen kapcsolodás!";
        else
            $szoveg = "Sikeres kapcsolodás!";
        //ékezetes betűk miatt
        $this->kapcsolat->query('SET NAMES UTF8');
        $this->kapcsolat->query('SET CHARACTER SET UTF8');
        //echo $szoveg;
    }
    //egyéb metódusok
    public function adatLeker($oszlop, $tabla)
    {
        $sql = "SELECT $oszlop FROM $tabla";
        $adatok = $this->kapcsolat->query($sql);
        /*if ($adatok)
            echo "Sikeres lekérdezés";
        else
            echo "Sikeres lekérdezés";*/
        return $adatok;
    }

    function adatLeker2($melyik1, $melyik2, $tabla){
        $sql = "SELECT $melyik1, $melyik2 FROM $tabla ORDER BY $melyik1";
        return $this->kapcsolat->query($sql);
    }
    public function megvalosit($eredmeny){
        while ($sor = $eredmeny->fetch_row()) {
            echo "<img src=\"kepek/$sor[0]\" alt=\"$sor[0]\">";
        }
    }
    public function megvalositAsszoc($eredmeny, $melyik1, $melyik2){
        while ($row = $eredmeny->fetch_assoc()) {
            echo "$melyik1: $row[$melyik1]- $melyik2: $row[$melyik2] <br>";
        }
    }
    function azonMind($tabla){
        $result = $this->kapcsolat->query("SELECT * FROM $tabla");
        return $result->num_rows;
    }

    function kartyaFeltolt($tabla){
        $countSzin = $this->azonMind('szin')+1;
        $countForma = $this->azonMind('forma')+1;
        for ($indexSzin=1; $indexSzin < $countSzin; $indexSzin++) { 
            for ($indexForma = 1; $indexForma < $countForma;$indexForma++) { 
                $sql = "INSERT INTO $tabla(szinAzon, formaAzon) VALUES($indexSzin, $indexForma);";
                $this->kapcsolat->query($sql);
            }
        }
    }
    public function kapcsolatBezar(){
        $this->kapcsolat->close();
    }
}
?>