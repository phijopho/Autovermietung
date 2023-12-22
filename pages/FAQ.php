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
  <!--FAQ questions-->
  <article>
    <h1>Fragen und Antworten</h1>

    <dl id="ud_accordion">

      <!--question 1-->
      <dt>
        1. Wie alt muss ich sein, um ein Auto mieten zu k&Ouml;nnen?
      </dt>

      <dd>
        In der Regel m&uuml;ssen Sie mindestens 18 Jahre alt sein, um ein Auto mieten zu k&Ouml;nnen.
        F&uuml;r bestimmte Fahrzeugkategorien kann das Mindestalter jedoch h&Ouml;her sein.
      </dd>


      <!--question 2-->
      <dt>
        2. Welche Dokumente ben&Ouml;tige ich zur Anmietung eines Autos?
      </dt>

      <dd>
        Sie ben&Ouml;tigen einen g&uuml;ltigen F&uuml;hrerschein, einen Ausweis und oft auch eine Kreditkarte f&uuml;r eine Kaution, die vor Ort erhoben wird.
      </dd>


      <!--question 3-->
      <dt>
        3. Wie erfolgt die Bezahlung f&uuml;r die Automietung?
      </dt>

      <dd>
        Die Bezahlung kann durch folgende Bezahlm&Ouml;glichkeiten erfolgen: Mastercard, Mastero, Cirrus, Visa, Klarna oder per SEPA-Lastschriftmandat.
      </dd>


      <!--question 4-->
      <dt>
        4. Welche Versicherungen sind im Mietpreis enthalten?
      </dt>

      <dd>
        Die Automiete enth&auml;lt standartm&auml;&szlig;ig eine Haftpflichtversicherung. Zus&auml;tzliche Versicherungen k&Ouml;nnen nicht gekauft werden.
      </dd>


      <!--question 5-->
      <dt>
        5. Kann ich das gemietete Auto in einer anderen Stadt abgeben?
      </dt>

      <dd>
        Nein, das ist nicht m&Ouml;glich. Abholung und R&uuml;ckgabe erfolgt in der selben Stadt.
      </dd>


      <!--question 6-->
      <dt>
        6. Wie funktioniert die Tankregelung?
      </dt>

      <dd>
        Die g&auml;ngisten Tankoptionen sind: <br>
        -"voll/voll" (Sie erhalten das Auto mit vollem Tank und m&uuml;ssen es genauso zur&uuml;ckgeben.) <br>
        -"voll/leer" (Sie zahlen im Voraus f&uuml;r einen vollen Tank und k&Ouml;nnen das Auto mit leerem Tank zur&uuml;ckgeben.) <br>
        W&auml;hlen Sie die Option, die Ihren Bed&uuml;rfnissen am besten entspricht.
      </dd>


      <!--question 7-->
      <dt>
        7. Was passiert, wenn ich das Auto zu sp&auml;t zur&uuml;ckgebe?
      </dt>

      <dd>
        Versp&auml;tete R&uuml;ckgaben k&Ouml;nnen zus&auml;tzliche Geb&uuml;hren nach sich ziehen.
        Es ist wichtig das Auto rechtszeitig zur&uuml;ckzubringen.
      </dd>


      <!--question 8-->
      <dt>
        8. Gibt es eine Kilometerbegrenzung?
      </dt>

      <dd>
        Nein, gibt es nicht. Wenn der Tank jedoch leer ist, m&uuml;ssen Sie sich eigenst&auml;ndig um die Tankbef&uuml;llung k&uuml;mmern.
      </dd>


      <!--question 9-->
      <dt>
        9. Kann ich ein bestimmtes Auto-Modell w&auml;hlen?
      </dt>

      <dd>
        Die Autovermietung bietet die M&Ouml;glichkeit ein bestimmtes Modell zu w&auml;hlen, dies h&auml;ngt jedoch von der Verf&uuml;gbarkeit ab.
      </dd>


      <!--question 10-->
      <dt>
        10. Was muss ich bei einem Unfall tun?
      </dt>

      <dd>
        Im Falle eines Unfalls informieren Sie sofort die Vermietung. Folgen Sie den Anweisungen des Vermieters und dokumentieren Sie den Unfall so gut wie m&Ouml;glich.
      </dd>
    </dl>

    <!--link to contactForm-->
    <p>
      Haben Sie weitere Fragen? 
      <a href="pages/contactForm.php" class="contactForm">
        Hier klicken f&uuml;r unser Kontaktformular!
      </a>
    </p>
    
  </article>

</body>

<?php
include('../includes/footer.html');
?>

</html>