<div class="BackgroundAudi">
    <div class="containerBookingForm">
        <h1>Buchung</h1>
        <form action="#" method="post">
            <label>Abholort:</label>
            <select name="pickup-location">
                <option value="Hamburg">Hamburg</option>
                <option value="Berlin">Berlin</option>
                <option value="München">München</option>
            </select>
            <label>Abholdatum</label>
            <input type="date" name="pickup-date" value="<?php echo date('Y-m-d'); ?>" />
            <label>Rückgabedatum</label>
            <input type="date" name="return-date" value="<?php echo date('Y-m-d'); ?>" />
            <button type="button">Mietwagen suchen</button>
        </form>
    </div>
</div>

