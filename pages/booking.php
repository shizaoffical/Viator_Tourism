
<?php
include '../includes/header.php';
?>

<div id="booking">
    <div class="text-center heading">
        <h1 class="gradient-text">Booking</h1>
    </div>
    <div class="contact-us">
        <div>
            <img src="./assets/images/contact us.jpg" alt="No Image">
        </div>
        <div class="contact-form-container">
            <form id="contact-form" class="contact-form">
                <div class="form-group">
                    <label for="name">Where to</label>
                    <input type="text" id="name" name="name" required />
                </div>
                <div class="form-group">
                    <label for="email">How Many</label>
                    <input type="number" id="number" name="2" required />
                </div>
                <div class="form-group">
                    <label for="email">Arrival</label>
                    <input type="date" id="arrival" name="07/10" required />
                </div>
                <div class="form-group">
                    <label for="email">Leaving</label>
                    <input type="date" id="leaving" name="15/10" required />
                </div>
                <button type="submit" class="main-button" style="margin-top: 10px; padding: 10px 20px;">Send
                    Message</button>
            </form>
        </div>
    </div>
</div>


<?php
include '../includes/footer.php';
?>