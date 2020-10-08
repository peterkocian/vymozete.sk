@php
    $config = [
        'amount' => $amount,
        'claim_id' => $claim_id,
        'splatky' => $events,
        'validationErrors' => $errors->messages(),
    ];
@endphp
<calendar-component
    :config="{{ json_encode($config) }}"
></calendar-component>
