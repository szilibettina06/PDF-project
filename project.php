<!-- A megadott pdf tartalmát valahogy úgy beolvasni php-ben, hogy az szövegesen értelmezhető legyen. 
Meg kell keresni az oldalak végét, és az oldalakat külön tudni kell kezelni. Jó indikátor a feladat elvégzésére, 
ha pl meg tudjuk mondani egy random betöltött pdf-ről, hogy hány oldalt tartalmaz. Ha ez megvan, akkor már tuti, 
hogy oldalanként szét tudjuk bontani a fájlt. Ha ez megvan, akkor jön a 2. feladat.
Bizonyos szövegrészleteket meg kell találni a pdf-ben. A teszt kedvéért, mindegy hogy mit, 
de valami oylan szövegen teszteljétek ami tartalmaz ékezeteket is. Valójában azonban nem is az a fontos, hogy az adott szövegrészt megtaláljuk, 
hanem az, hogy az adott szövegrész után lévő értéket ki tudjuk szedni. Pl.: Nettó összeg: 30 000 Ft. Ebben az esetben a nettó összeg nyilván mindig más lesz, 
de mindig a "Nettó összeg: " felirat szerepel előtte, de nekünk természetesen maga a 30 000 Ft kell.
Ha sikerült kiszedni az infókat a pdf-ből, akkor ugyanazzal a tartalommal ami van a pdf-ben, le kell generálni egy új pdf-et úgy, 
hogy a megtalált szövegrészletek valahogy ki vannak emelve. Kezdésnek h abekeretezzük, vagy aláhúttuk, azh elég, utána majd finomíthatjuk. -->

<?php

// PDF fájl elérési útvonala
 $pdfFile = 'pdffeldolg.pdf';

// TCPDF könyvtár betöltése
 require_once('D:\MAMP\htdocs/TCPDF-main/tcpdf.php');

// PDF objektum létrehozása
$pdf = new TCPDF();
$pdf->setSourceFile($pdfFile);

// Oldalak számának lekérdezése
$pageCount = $pdf->getNumPages();

echo "A PDF fájl $pageCount oldalt tartalmaz.";

// Oldalankénti szöveges tartalom kezelése például TCPDF használatával
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    // Oldal hozzáadása
    $pdf->AddPage();

    // Oldal tartalmának beolvasása
    $tplIdx = $pdf->importPage($pageNo);
    $pdf->useTemplate($tplIdx);

    // Oldal tartalmának kinyerése szöveges formátumban (először menthető)
    $text = $pdf->getTextFromPage($pageNo);

    // Oldal tartalmának kezelése
    echo "Az $pageNo. oldal tartalma: <br>";
    echo nl2br($text); // HTML sortörés hozzáadása
}

// TCPDF objektum lezárása
$pdf->end();
 

?>