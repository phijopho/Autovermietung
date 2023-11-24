<!DOCTYPE html>
<html>
    <body>

    <form>
    <br>
    <?php
    require_once '../includes/dbConnection.php';
    $result=$conn->query("SELECT Image FROM CarType");

    if($result->rowCount()>0){ ?>
        <div class="gallery">
            <?php while($row=$result->fetch()){ ?>
                <img src="data:image/pnh;charset=utf8;base64, <?php echo base64_encode($row['Image']); ?>" />
            <?php } ?>
        </div>
    <?php } else { ?>
        <p class="status error">Image(s) not found...</p>
    <?php } ?>

    <br>
    <form action="imageUpload.php" method="post">
        <input type="submit" name="backToImageUpload" value="Upload image">
    </form>
    </body>
</html>