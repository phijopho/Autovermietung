<!-- Meine Buchungen -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accordion Tabelle</title>
    <base href="/Autovermietung/">
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="css/styleMeineBuchungen.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<?php
include('../includes/header.html');
?>

<h1>Buchungsübersicht</h1>

<div class="tabelle">
    <table>
        <thead>
            <tr>
                <th>Buchungs-ID</th>
                <th>Abholdatum</th>
                <th>Rückgabedatum</th>
                <th>Hersteller</th>
                <th>Modell</th>
                <th>Buchungsdatum</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>23.12.2023</td>
                <td>25.12.2023</td>
                <td>Audi</td>
                <td>A3</td>
                <td>29.11.2023</td>
            </tr>
            <!-- Weitere Buchungen hier einfügen -->
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        $(".tabelle tbody tr").click(function(){
            $(this).toggleClass("active").siblings().removeClass("active");
        });
    });
</script>



<?php
include('../includes/footer.html');
?>

</body>
</html>
