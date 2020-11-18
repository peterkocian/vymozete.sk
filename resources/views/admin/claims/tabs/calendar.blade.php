@php
    $config = [
        'amount' => $amount,
        'currency' => $currency,
        'claim_id' => $claim_id,
        'splatky' => $events,
        'sum' => $sum,
        'validationErrors' => $errors->messages(),
    ];
@endphp
<calendar-component
    :config="{{ json_encode($config) }}"
></calendar-component>
