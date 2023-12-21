<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../includes/htmlhead.php')
    ?>
    
    <!-- html page specifics -->
    <link rel="stylesheet" href="css/styleFAQ.css">
    <link rel="stylesheet" href="css/styleFooter.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Fragen und Antworten</title>
    <script src="includes/functions.js"></script>
</head>

<?php
include('../includes/header.php'); // Including the header
?>

<!--js code for accordion-->
<script>
  $(document).ready(function() { //code execudes when document is fully loaded
    $("#ud_accordion dt") //selects all elements within the accordion
      .stop()
      .click(function() {
        if ($(this).hasClass("ud_active")) { //checking if the clicked <dt> has the class ud_active
          $(this).removeClass("ud_active"); //current element "this" is removed from ud_active
          $(this)
            .next()
            .slideUp(300);
        } else { //if the clicked <dt> has not ud_active, all <dt> elements are removed from ud_active
          $(this)
            .parent()
            .children()
            .removeClass("ud_active");
          $(this).addClass("ud_active"); //adds the class ud_active to the current element "this"
          if ( //check if the next element of <dt> is a <dd>element
            $(this)
            .next()
            .is("dd")
          ) {
            $(this) //search for all <dd> elements in the container <dt> and close them by sliding up
              .parent()
              .children("dd")
              .slideUp(300);
            $(this) //when <dt> element is clicked, the next element is faded in.the animation duration is 300 milliseconds 
              .next()
              .slideDown(300);
          }
        }
      });
  });
</script>



<body>
  <!--Buchungsdaten Übersicht-->
  <article>
    <h1>Fragen und Antworten</h1>

    <dl id="ud_accordion">

      <!--Frage 1-->
      <dt>
        1. Wie alt muss ich sein, um ein Auto mieten zu können?
      </dt>

      <dd>
        In der Regel müssen Sie mindestens 18 Jahre alt sein, um ein Auto mieten zu können.
        Für bestimmte Fahrzeugkategorien kann das Mindestalter jedoch höher sein.
      </dd>


      <!--Frage 2-->
      <dt>
        2. Welche Dokumente benötige ich zur Anmietung eines Autos?
      </dt>

      <dd>
        Sie benötigen einen gültigen Führerschein, einen Ausweis und oft auch eine Kreditkarte für eine Kaution, die vor Ort erhoben wird.
      </dd>


      <!--Frage 3-->
      <dt>
        3. Wie erfolgt die Bezahlung für die Automietung?
      </dt>

      <dd>
        Die Bezahlung kann durch folgende Bezahlmöglichkeiten erfolgen: Mastercard, Mastero, Cirrus, Visa, Klarna oder per SEPA-Lastschriftmandat.
      </dd>


      <!--Frage 4-->
      <dt>
        4. Welche Versicherungen sind im Mietpreis enthalten?
      </dt>

      <dd>
        Die Automiete enthält standartmäßig eine Haftpflichtversicherung. Zusätzliche Versicherungen können nicht gekauft werden.
      </dd>


      <!--Frage 5-->
      <dt>
        5. Kann ich das gemietete Auto in einer anderen Stadt abgeben?
      </dt>

      <dd>
        Nein, das ist nicht möglich. Abholung und Rückgabe erfolgt in der selben Stadt.
      </dd>


      <!--Frage 6-->
      <dt>
        6. Wie funktioniert die Tankregelung?
      </dt>

      <dd>
        Die gängisten Tankoptionen sind: <br>
        -"voll/voll" (Sie erhalten das Auto mit vollem Tank und müssen es genauso zurückgeben.) <br>
        -"voll/leer" (Sie zahlen im Voraus für einen vollen Tank und können das Auto mit leerem Tank zurückgeben.) <br>
        Wählen Sie die Option, die Ihren Bedürfnissen am besten entspricht.
      </dd>


      <!--Frage 7-->
      <dt>
        7. Was passiert, wenn ich das Auto zu spät zurückgebe?
      </dt>

      <dd>
        Verspätete Rückgaben können zusätzliche Gebühren nach sich ziehen.
        Es ist wichtig das Auto rechtszeitig zurückzubringen.
      </dd>


      <!--Frage 8-->
      <dt>
        8. Gibt es eine Kilometerbegrenzung?
      </dt>

      <dd>
        Nein, gibt es nicht. Wenn der Tank jedoch leer ist, müssen Sie sich eigenständig um die Tankbefüllung kümmern.
      </dd>


      <!--Frage 9-->
      <dt>
        9. Kann ich ein bestimmtes Auto-Modell wählen?
      </dt>

      <dd>
        Die Autovermietung bietet die Möglichkeit ein bestimmtes Modell zu wählen, dies hängt jedoch von der Verfügbarkeit ab.
      </dd>


      <!--Frage 10-->
      <dt>
        10. Was muss ich bei einem Unfall tun?
      </dt>

      <dd>
        Im Falle eines Unfalls informieren Sie sofort die Vermietung. Folgen Sie den Anweisungen des Vermieters und dokumentieren Sie den Unfall so gut wie möglich.
      </dd>
    </dl>

    <p>
      Haben Sie weitere Fragen? 
      <a href="http://localhost/Autovermietung/pages/contactForm.php" class="contactForm">
        Hier klicken für unser Kontaktformular!
      </a>
    </p>
    
  </article>

</body>

<?php
include('../includes/footer.html');
?>

</html>