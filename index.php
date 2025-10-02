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
    <h1 class="mt-5 mb-3">Notenerfassung!</h1>

    <form id="form_grade" action="index.php" method="post">
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="name">Name*</label>
                <input type="text" name="name" class="form-control"
                maxlength="">
            </div>

            <div class="col-sm-6 form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 form-group">
                <label for="subject">Fach*</label>
                <select name="subject" class="form-select">
                    <option>Mathematik</option>
                    <option>Deutsch</option>
                    <option>Englisch</option>
                </select>
            </div>

            <div class="col-sm-4 form-group">
                <label for="grade">Note*</label>
                <input type="number" name="grade" class="form-control"/>
            </div>

            <div class="col-sm-4 form-group">
                <label for="examDate">Prüfungsdatum</label>
                <input type="date" name="examDate" class="form-control"/>
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
</body>
</html>
