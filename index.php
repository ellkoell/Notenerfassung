<?php

session_start();
require_once "models/GradeEntry.php";

$e = new \models\GradeEntry();
$message = '';

if (isset($_POST['submit'])){



    $e->setName(isset($_POST['name']) ? $_POST['name'] : "");
    $e->setEmail(isset($_POST['email']) ? $_POST['email'] : "");
    $e->setExamDate(isset($_POST['examDate']) ? $_POST['examDate'] : "");
    $e->setGrade(isset($_POST['grade']) ? $_POST['grade'] : "");
    $e->setSubject(isset($_POST['subject']) ? $_POST['subject'] : "");  //$_Post ist das array in dem alle formulardaten gespeichert werden

    if ($e->validate()) {
        $e->save();
        $message= "<p class='alert alert-success'>Die eingegebenen Daten sind in Ordnung!<p>";
    }else {
        $message = "<div class='alert alert-danger'><p>Die eingegebenen Daten sind fehlerhaft!</p><ul>";
        foreach ($e->getErrors() as $key => $value){
            $message.="<li>". $value . "</li>";
        }
     $message.="</ul></div>";
        }


}


?>


<!doctype html>
<html lang="de">
<head>
    <!--Client und Serverseitige Validierung, clientseitige deshalb, weil schon vor abschicken geprüft wird, und dann
      bessere usability-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>Notenerfassung</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-3">Notenerfassung</h1>



    <form id="form_grade" action="index.php" method="post">
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="name">Name*</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($name) ?>"
                       maxlength="20"
                       required
                />
                <?php if (isset($errors['name'])): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($errors['name']) ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="col-sm-6 form-group">
                <label for="email">Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($email) ?>"
                />
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($errors['email']) ?>
                    </div>
                <?php endif; ?>
            </div>


        </div>

        <div class="row">
            <div class="col-sm-4 form-group">
                <label for="subject">Fach*</label>
                <select name="subject" class="form-select"
                <?= isset($errors['subject']) ? 'is-invalid' : '' ?>"
                required>
                    <option value="" hidden>-Fach auswählen-</option>
                    <option value="m" <?= $subject == 'm' ? 'selected' : '' ?>>Mathematik</option>
                    <option value="d" <?= $subject == 'd' ? 'selected' : '' ?>>Deutsch</option>
                    <option value="e" <?= $subject == 'e' ? 'selected' : '' ?>>Englisch</option>


                </select>
            </div>

            <div class="col-sm-4 form-group">
                <label for="grade">Note*</label>
                <input type="number" name="grade" class="form-control" min="1" max="5"
                <?= isset($errors['grade']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($grade) ?>"required/>
            </div>

            <div class="col-sm-4 form-group">
                <label for="examDate">Prüfungsdatum</label>
                <input type="date" name="examDate"
                <?= isset($errors['examDate']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($examDate) ?>"class="form-control" required
                onchange="validateExamDate(this)"/>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-3 mb-3">
                <input type="submit" name="submit" class="btn btn-primary w-100" value="Validieren">
            </div>

            <div class="col-sm-3">
                <a href="index.php" class="btn btn-secondary btn-block w-100">Löschen</a>
            </div>
        </div>
    </form>
</div>
<script src="js/index.js"></script>
</body>
</html>
