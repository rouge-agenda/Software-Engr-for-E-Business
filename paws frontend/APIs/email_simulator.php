<?php
//This is a simulated email API for SendGrid

function simulateSendGridEmail($to, $subject, $template, $orderData) {
    // Simulate email sending
    $validEmail = filter_var($to, FILTER_VALIDATE_EMAIL);
    
    if (!$validEmail) {
        return [
            
            'success' => false,
            'error' => 'Invalid email address',
            'simulated_api' => 'SendGrid'
        ];
    }

    //simulate different email templates
    $templates = [
        'order_confirmation' => [
            'subject' => 'Your order has been confirmed - Pawnovation Pets',
            'status' => 'sent'
        ],

        'shipping_notification' => [
            'subject' => 'Your order has been shipped - Pawnovation Pets',
            'status' => 'sent'
        ]
        ];

    // Simulate email sending delay
    sleep(1);

    if (isset($templates[$template])) {
        $templateConfig = $templates[$template];
    } else {
        $templateConfig = $templates['order_confirmation'];
    }

    return [
        'success' => true,
        'message_id' =>  'MSG_' . uniqid(),
        'to' => $to,
        'subject' => $templateConfig['subject'],
        'status' => $templateConfig['status'],
        'simulated_api' => 'SendGrid',
        'message' => 'Email sent successfully via SendGrid'
    ];
}
?>