<?php
error_reporting(0);
// load composer
require 'vendor/autoload.php';

if (isset($_POST['submit']) && $_POST['submit'] == 'split-pdf') {
    if (isset($_FILES['filePDF'], $_POST['page']) && $_FILES['filePDF']['error'] == 0 && $_FILES['filePDF']['type'] == 'application/pdf' && $_FILES['filePDF']['size'] > 0 && $_FILES['filePDF']['size'] < 25000000 && $_FILES['filePDF']['name'] != '' && $_FILES['filePDF']['tmp_name'] != '' && $_POST['page'] != '') {
        $sourceFile = $_FILES['filePDF']['tmp_name'];
        $page = $_POST['page'];
        // remove space
        $page = str_replace(' ', '', $page);
        // remove all except number, comma, and dash
        $page = preg_replace('/[^0-9,-]/', '', $page);
        // split page ,
        $page = explode(',', $page);

        $num = 1;
        foreach ($page as $p) {
            $new_pdf = new setasign\Fpdi\FPDI();
            $new_pdf->AddPage();
            $new_pdf->setSourceFile($sourceFile);
            $pageCount = $new_pdf->setSourceFile($sourceFile);

            // split page -
            $p = explode('-', $p);
            // check page 
            if (count($p) == 1) {
                // run
                $new_pdf->useTemplate($new_pdf->importPage($p[0]));
            } else if (count($p) == 2) {
                if ($p[0] < $p[1]) {
                    for ($i = $p[0]; $i <= $p[1]; $i++) {
                        if ($i > $pageCount || $i < 1) {
                            continue;
                        }
                        // run
                        $new_pdf->useTemplate($new_pdf->importPage($i));
                        if ($i != $p[1]) {
                            $new_pdf->AddPage();
                        }
                    }
                } else {
                    for ($i = $p[0]; $i >= $p[1]; $i--) {
                        if ($i > $pageCount || $i < 1) {
                            continue;
                        }
                        // run
                        $new_pdf->useTemplate($new_pdf->importPage($i));
                        if ($i != $p[1]) {
                            $new_pdf->AddPage();
                        }
                    }
                }
            } else {
                continue;
            }

            try {
                // base_path this file and server name
                $base_path = $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);

                $rand_string = substr(md5(microtime()), rand(0, 26), 15);
                $new_filename = $rand_string . '_' . $num . ".pdf";
                $folder = "temp/";
                $final_filename = $folder . $new_filename;
                $new_pdf->Output($final_filename, "F");
                // echo "Split " . $num . " into " . $new_filename . "<br />\n";
                // download
                echo "[$num] - [<a href='" . $final_filename . "' download>Download</a>] - [<a href='" . $final_filename . "'  target='_blank'>Preview</a>] <br/>\n";
                $num++;
            } catch (Exception $e) {
                // echo 'Caught exception: ',  $e->getMessage(), "\n";
                echo "Ada kesalahan <br>\n";
            }
        }
    }else{
        echo "Ada kesalahan <br>\n";
    }
}else{
    echo "Ada kesalahan <br>\n";
}
