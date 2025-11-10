<?php
session_start();
require_once "models/GradeEntry.php";

$e = new \models\GradeEntry();
$message = '';

// Daten aus POST übernehmen
if (isset($_POST['submit'])) {
    $e->setName(isset($_POST['name']) ? $_POST['name'] : "");
    $e->setEmail(isset($_POST['email']) ? $_POST['email'] : "");
    $e->setExamDate(isset($_POST['examDate']) ? $_POST['examDate'] : "");
    $e->setGrade(isset($_POST['grade']) ? $_POST['grade'] : "");
    $e->setSubject(isset($_POST['subject']) ? $_POST['subject'] : "");

    if ($e->validate()) {
        $e->save();
        $message = "<p class='alert alert-success'>Die eingegebenen Daten sind in Ordnung!</p>";
    } else {
        $message = "<div class='alert alert-danger'><p>Die eingegebenen Daten sind fehlerhaft!</p><ul>";
        foreach ($e->getErrors() as $key => $value) {
            $message .= "<li>" . htmlspecialchars($value) . "</li>";
        }
        $message .= "</ul></div>";
    }
}

?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Notenerfassung 2.0</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-3">Notenerfassung 2.0</h1>

    <?= $message ?>

    <form id="form_grade" action="index.php" method="post">
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="name">Name*</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-control <?= $e->hasErrors('name') ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($e->getName()) ?>"
                       maxlength="20"
                       required
                />
                <?php if ($e->hasErrors('name')): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($e->getErrors()['name']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-sm-6 form-group">
                <label for="email">Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       class="form-control <?= $e->hasErrors('email') ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($e->getEmail()) ?>"
                       maxlength="50"
                       required
                />
                <?php if ($e->hasErrors('email')): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($e->getErrors()['email']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 form-group">
                <label for="subject">Fach*</label>
                <select name="subject"
                        class="form-control <?= $e->hasErrors('subject') ? 'is-invalid' : '' ?>"
                        required>
                    <option value="" hidden>-Fach auswählen-</option>
                    <option value="m" <?= $e->getSubject() == 'm' ? "selected" : "" ?>>Mathematik</option>
                    <option value="d" <?= $e->getSubject() == 'd' ? "selected" : "" ?>>Deutsch</option>
                    <option value="e" <?= $e->getSubject() == 'e' ? "selected" : "" ?>>Englisch</option>
                </select>
                <?php if ($e->hasErrors('subject')): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($e->getErrors()['subject']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-sm-4 form-group">
                <label for="grade">Note*</label>
                <input type="number"
                       name="grade"
                       class="form-control <?= $e->hasErrors('grade') ? 'is-invalid' : '' ?>"
                       min="1" max="5"
                       value="<?= htmlspecialchars($e->getGrade()) ?>"
                       required/>
                <?php if ($e->hasErrors('grade')): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($e->getErrors()['grade']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-sm-4 form-group">
                <label for="examDate">Prüfungsdatum</label>
                <input type="date"
                       name="examDate"
                       class="form-control <?= $e->hasErrors('examDate') ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($e->getExamDate()) ?>"
                       required
                />
                <?php if ($e->hasErrors('examDate')): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($e->getErrors()['examDate']) ?>
                    </div>
                <?php endif; ?>
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


    <h2 class="mt-3">Noten</h2>
    <div id="grades">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Prüfungsdatum</th>
                <th>Fach</th>
                <th>Note</th>
            </tr>

            </thead>
            <tbody>
            <?php


            $grades = \models\GradeEntry::getAll();


            foreach ($grades as $g) {
                echo "<tr>";
                echo "<td>" . $g->getName() . "</td>";
                echo "<td>" . $g->getEmail() . "</td>";
                echo "<td>" . $g->getExamDateFormatted() . "</td>";
                echo "<td>" . $g->getSubjectFormatted() . "</td>";
                echo "<td>" . $g->getGrade() . "</td>";
                echo "</tr>";
            }
            ?>


            </tbody>

        </table>


    </div>

<form action="clear.php" method="post">
    <input type="submit" name="clear" class="btn-btn-danger" value="Alle Noten löschen"/>


</form>
</div>
<script src="js/index.js"></script>
</body>
</html>
