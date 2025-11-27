<?php
//This is a simulated shipping API for Shippo

function simulateShippoShipping($address, $city, $state, $zip, $items) {

    //Simulate Shippo API Validation
    $validAddress = !empty($address) && !empty($city) && !empty($state) && preg_match('/^\d{5}$/', $zip);
    
    if (!$validAddress) {
        return [
            'success' => false,
            'error' => 'Invalid shipping address',
            'simulated_api' => 'Shippo'
        ];
    }

    $shippingOptions = [
        [
            'service' => 'standard',
            'carrier' => 'USPS',
            'cost' => 5.99,
            'tracking_id' => 'SH_' . uniqid()
        ],
        [
            'service' => 'express',
            'carrier' => 'FedEx',
            'cost' => 12.99,
            'tracking_id' => 'SH_' . uniqid()
        ]
    ];

    //Simulate shipping processing delay
    sleep(1);

    return [
        'success' => true,
        'shipping_options' => $shippingOptions,
        'simulated_api' => 'Shippo',
        'message' => 'Shipping rates calculated successfully'
    ];
}
?>