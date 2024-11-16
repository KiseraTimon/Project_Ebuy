<!DOCTYPE html>
<html>
<head>
    <title>Verify purchase</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/pageclasses/assets/css/verify.css">
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="/defaults.css">
</head>
<body>

    <?php
    require_once ('../loader.php');

    $header->navigation();
    
    ?>
    <div class="ver-body">
        <form method="POST" action="/pageclasses/assets/php/transaction.php">
            <div class="form-data">
                <!--Verification Code-->
                <div class="form-row">
                    <div class="col">
                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter transaction code (e.g. SMFJE8003E)" maxlength="20">
                    </div>
                </div>
    
                <!--Submit Button-->
                <div class="form-row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Verify</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php

    $footer->footercont();
    ?>