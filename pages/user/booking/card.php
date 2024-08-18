<?php
include('../../../includes/db.php');

// Retrieve POST data
$bus_id = isset($_POST['bus_id']) ? $_POST['bus_id'] : null;
$seats = isset($_POST['seats']) ? $_POST['seats'] : null;

if ($bus_id === null || $seats === null) {
    echo 'Missing required parameters';
    exit;
}

// Prepare and execute the query
$sql = "SELECT * FROM buses WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $bus_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Fetch the result
    if (mysqli_num_rows($result) > 0) {
        $bus = mysqli_fetch_assoc($result);
        $bus_price = $bus['price']; // Assuming the column name for the price is 'price'
        $booking_date_time = $bus['departure_time'];
        // Calculate total amount
        $total_amount = $bus_price * $seats;
        
        // Return the details and calculated amount
        echo json_encode([
            'bus' => $bus,
            'total_amount' => $total_amount
        ]);
    } else {
        echo json_encode(['error' => 'Bus not found']);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['error' => 'Query preparation failed']);
}


?>
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        #payment-form {
            max-width: 400px;
            margin: 0 auto;
        }
        .form-row {
            margin-bottom: 15px;
        }
        .form-row label {
            display: block;
            margin-bottom: 5px;
        }
        #card-errors {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Payment Page</h2>
    <form id="payment-form" action="create-checkout-session.php" method="POST">
        <input type="text" name="bus_id" value="<?php echo htmlspecialchars($bus_id); ?>">
        <input type="text" name="seats" value="<?php echo htmlspecialchars($seats); ?>">
        <input type="text" name="booking_date" value="<?php echo htmlspecialchars($booking_date_time); ?>">
        <input type="text" name="amount" value="<?php echo htmlspecialchars($total_amount ); ?>">
        <div class="form-row">
            <label for="card-element">Credit or debit card</label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        <button type="submit">Pay</button>
    </form>

    <script>
        // Set your publishable key here
        var stripe = Stripe('pk_test_51MVCGyFaWK1ZSTpIH9lWMYoVJ9YZ2oLOV4LIJQbjwebRUPHRGiaA2jpDFY5CuRDyzrN0JJTwNdOY6j5VRqxIK0lf00bp1faCFT'); // Replace with your Stripe public key
        var elements = stripe.elements();

        // Create an instance of the card Element
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Create a token
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID
        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
</body>
</html>
