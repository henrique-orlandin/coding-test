<?php

function writeDataintoCSV($file, $html) {
    //place where the excel file is created
    $myFile = "userfiles/testexcel.xls";

    //open excel and write string into excel
    $fh = fopen($myFile, 'w') or die("can't open file");
    fwrite($fh, $html);

    fclose($fh);
    //download excel file
    downloadExcel($file);
}

function downloadExcel($file) {
    $myFile = "userfiles/" . $file . ".xls";
    header("Content-Length: " . filesize($myFile));
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=' . $file . '.xls');

    readfile($myFile);
}