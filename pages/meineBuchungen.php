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
            <tr class="accordion-toggle">
                <td>001</td>
                <td>23.12.2023</td>
                <td>25.12.2023</td>
                <td>Audi</td>
                <td>A3</td>
                <td>29.11.2023</td>
            </tr>
            <!-- Weitere Buchungen hier einfügen -->
            <tr class="accordion-content">
                <td colspan="6">
                    <!-- Hier kommt der Inhalt des aufklappbaren Elements -->
                    <p>Zusätzliche Informationen zur Buchung 001.</p>
                    <p>Dies könnte der Ort für weitere Details sein.</p>
                </td>
            </tr>
            <tr class="accordion-toggle">
                <td>002</td>
                <td>26.12.2023</td>
                <td>28.12.2023</td>
                <td>BMW</td>
                <td>3er</td>
                <td>30.11.2023</td>
            </tr>
            <tr class="accordion-content">
                <td colspan="6">
                    <!-- Hier kommt der Inhalt des aufklappbaren Elements -->
                    <p>Zusätzliche Informationen zur Buchung 002.</p>
                    <p>Weitere Details könnten hier stehen.</p>
                </td>
            </tr>
            <!-- Füge weitere Buchungen und Inhalte hier ein -->
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        $(".accordion-content").hide(); // Verstecke alle Inhalte zu Beginn

        $(".accordion-toggle").click(function(){
            $(this).next(".accordion-content").slideToggle().siblings(".accordion-content").slideUp();
        });
    });
</script>

<?php
include('../includes/footer.html');
?>

</body>
</html>

