<?php 
include('includes/dbConnection.php');
include("./includes/functions.php");

$pickUpLocation = array("Hamburg");
$default="Hamburg";
$stmtGetCities = $conn->prepare("SELECT City FROM Location WHERE City!=:cityIdent");
$stmtGetCities->bindParam(':cityIdent', $default);
$stmtGetCities->execute();
while($row = $stmtGetCities->fetch()){
    $pickUpLocation[] = $row['City'];
}
?>

<div class="divBackgroundAudi"> 
    <div class="divContentContainer">
        <div class="divBookingForm">
            <div class="divContainerBookingForm">
            <!-- <h1>Buchung</h1> -->
            <!-- Link zur Produktübersichtseite statt index -->
            <form action="./index.php" method="post"> 
                <label for="Abholort">Abholort:</label>
                    <select id="Abholort" name="Abholort">
                        <?php //aus Datenbank ziehen, außer HH
                        foreach($pickUpLocation as $city){
                        echo "<option value='$city'>$city</option>";
                        }
                        ?>
                    </select>
                <label for "Abholdatum">Abholdatum:</label>
                    <input type="date" name="Abholdatum" value="<?php echo date('Y-m-d'); ?>" />
                <label for "Rueckgabedatum">R&uuml;ckgabedatum:</label>
                    <input type="date" name="Rueckgabedatum" value="<?php echo date('Y-m-d'); ?>" /><br><br>
                    <input type="submit" value="Suchen">
            </form>
        </div>

    </div>


    <div class="divPrices">
            <table>
                <tr>
                    <th>Klasse </th>
                    <th>Preis von</th>
                    <th>bis</th>
                </tr>
                <tr>
                    <td>Combi</td>
                    <td>
                        <?php $MinPriceCombi=getMinMaxPrice("Combi");
                        echo "".$MinPriceCombi['min'];
                        ?> 
                    </td>
                    <td>
                        <?php 
                        $MinPriceCabrio=getMinMaxPrice("Combi");
                        echo "".$MinPriceCombi['max'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Cabrio</td>
                    <td>
                        <?php 
                            $MinPriceCabrio=getMinMaxPrice("Cabrio");
                            echo "".$MinPriceCabrio['min'];
                        ?> 
                    </td>
                    <td>
                        <?php 
                            $MinPriceCabrio=getMinMaxPrice("Cabrio");
                            echo "".$MinPriceCabrio['max'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Limousine</td>
                    <td>
                        <?php 
                            $MinPriceLimousine=getMinMaxPrice("Limousine");
                            echo "".$MinPriceLimousine['min'];
                        ?>
                    </td>
                    <td>
                        <?php 
                            $MinPriceLimousine=getMinMaxPrice("Limousine");
                            echo "".$MinPriceLimousine['max'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>SUV</td>
                    <td>
                        <?php 
                            $MinPriceLimousine=getMinMaxPrice("SUV");
                            echo "".$MinPriceLimousine['min'];
                        ?>
                    </td>
                    <td>
                        <?php 
                            $MinPriceLimousine=getMinMaxPrice("SUV");
                            echo "".$MinPriceLimousine['max'];
                        ?>
                    </td>
                </tr>
                
            </table>
        </div>
    </div>
</div>


