<?php


use models\GradeEntry;

session_start();

require_once "models/GradeEntry.php";

if (isset($_POST['clear'])) {
    GradeEntry::deleteAll();
    header("Location: index.php");
    exit;
} else {
    http_response_code(405);
}