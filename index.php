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
                <input type="text" name="name" class="form-control">

            </div>


            <div class="col-sm-6 form-group">
                <label for="Email">Email</label>
                <input type="email" name="email" class="form-control">


            </div>
            <div class="row">
                <div class="col-sm-4 form-group">

                    <label for="subject">Fach*</label>
                    <select name="subject" class="custom-select">
                        <option>Mathematik</option>
                        <option>Deutsch</option>
                        <option>Englisch</option>

                    </select>

                </div>
    </form>
</div>
</body>
</html><?php
