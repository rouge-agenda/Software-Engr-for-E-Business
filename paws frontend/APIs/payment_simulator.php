<?php
//This is a simulated payment processing API for PayPal
function simulatePayPalPayment($cardNumber, $expiryDate, $cvv, $amount, $email) {

    //Simulate PayPal API Validation
    $cardValid = preg_match('/^\d{16}$/', str_replace(' ', '', $cardNumber));
    $expiryValid = preg_match('/^(0[1-9]|1[0-2])\/?([0-9]{2})$/', $expiryDate);
    $cvvValid = preg_match('/^[0-9]{3,4}$/', $cvv);

    if (!$cardValid || !$expiryValid || !$cvvValid) {
        return [
            'success' => false,
            'error_message' => 'Invalid payment details provided.',
            'simulated_api' => 'PayPal'
        ];
    }

    //Simulate payment processing delay
    sleep(1);

    return [
        'success' => true,
        'transaction_id' => 'PAYPAL_' . uniqid(),
        'amount' => $amount,
        'email' => $email,
        'status' => 'completed',
        'status_message' => 'Payment has been successfully processed through PayPal.',
        'simulated_api' => 'PayPal'
    ];
}
?>