<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Notenerfassung</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-3">Notenerfassung</h1>
    <?php
    require "lib/func.php";

    $name = '';
    $email = '';
    $examDate= '';
    $grade = '';
    $subject = '';

   // print_r($_POST);

    if (isset($_POST['submit'])){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $examDate = isset($_POST['examDate']) ? $_POST['examDate'] : '';
        $grade = isset($_POST['grade']) ? $_POST['grade'] : '';
        $subject = isset($_POST['subject']) ? $_POST['subject'] : '';

        if (validate($name, $email, $examDate, $subject, $grade)) {
            echo "<p class='alert alert-success'>Die eingegebenen Daten sind in Ordnung!<p>";
        }else {
            echo "<p class='alert alert-danger'>Die eingegebenen Daten sind fehlerhaft!</p>";
            if (!empty($errors)) {
                echo "<ul>";
                foreach ($errors as $key => $value) {
                    echo "<li>" . htmlspecialchars($value) . "</li>";
                }
                echo "</ul>";
            }
        }

        }

    ?>
    <form id="form_grade" action="index.php" method="post">
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="name">Name*</label>
                <input type="text"
                       name="name"
                       class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($name) ?>"
                       maxlength="20"
                       required
                />
            </div>

            <div class="col-sm-6 form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control"
                <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($email) ?>">
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
                       value="<?= htmlspecialchars($grade) ?>"/>
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
