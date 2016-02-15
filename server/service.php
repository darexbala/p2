<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', false);

$symbols = array('~', '`', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_',
    '=', '+', '{', '}', ']', '[', ':', ';', '\'', '"', '<', '.', '>', '/', '|', '?');
$words = array();
$numbers = array('1', '2', '3', '4', '5', '6', '7', '8', '9');

$password = $size = $separator = $maxlength = $Add_Number = $Add_Symbol = $case = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $size = $_POST["size"];
    $separator = $_POST["separator"];
    $maxlength = $_POST["maxlength"];
    if(isset($_POST['Add_Number'])){
        $Add_Number = $_POST["Add_Number"];
    }
    if(isset($_POST['Add_Symbol'])){
        $Add_Symbol = $_POST["Add_Symbol"];
    }
    $case = $_POST["case"];

    if(isset($_SESSION['words'])){
        $words = $_SESSION['words'];
    }

    if(empty($words))
    {
        for ($x = 1; $x <= 30; $x++) {
            $firstVal = $x;
            $secondVal = $firstVal + 1;
            if($firstVal < 10){
                $firstVal = sprintf( '%02d', $firstVal );
            }
            if($secondVal < 10){
                $secondVal = sprintf( '%02d', $secondVal );
            }
            $urlToScrape = 'http://www.paulnoll.com/Books/Clear-English/words-' . $firstVal . '-' .$secondVal . '-hundred.html';
            $pageContent = file_get_contents($urlToScrape);
            $match_count = preg_match_all('@<li>(.*?)</li>@si',$pageContent,$matches_all);
            foreach ($matches_all[1] as $value) {
                $words[] = $value;
            }
            $x++;
        }
        $_SESSION['words'] = $words;
    }

    $passwordList = [];
    $rand_keys = array_rand($words, intval($size));
    $keysLength = count($rand_keys);
    if($keysLength == 1){
        $rand_keys = array($rand_keys);
    }

    foreach ($rand_keys as $value) {
        $currVal = trim($words[$value]);
        switch ($case) {
            case 'First upper':
            $currVal = ucfirst($currVal);
            break;
            case 'All upper':
            $currVal = strtoupper($currVal);
            break;
            case 'All lower':
            $currVal = strtolower($currVal);
            break;
            default:
            break;
        }
        $passwordList[] = $currVal;
    }
    $password = implode($separator, $passwordList);

    if($Add_Number == 'on'){
        $password = $password . rand(1, 9);
    }
    if($Add_Symbol == 'on'){
        $password = $password . $symbols[array_rand($symbols)];
    }
}
?>
