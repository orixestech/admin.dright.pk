<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
    <h2>Medicine</h2>
    <p></p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Firstname</th>
            <th>Ingredients</th>
            <th>Dosage</th>
        </tr>
        </thead>
        <tbody>
<?php
$cnt = 0;
foreach ($Med as $record) {?>
        <tr>
            <td><?=$record['MedicineTitle']?></td>
            <td><?=$record['Ingredients']?></td>
            <td><?=$record['DosageForm']?></td>
        </tr>
        <?php   }
?>
        </tbody>
    </table>
</div>

</body>
</html>
