@php
    $config = [
        'stepData' => empty(session()->getOldInput()) ? $step->data() : session()->getOldInput(),
        'validationErrors' => $errors->messages(),
        'currencies' => $step->getCurrencies()
    ];
    if($step->data('payment_due_date')){
        $config['stepData']['payment_due_date'] = \Carbon\Carbon::parse($config['stepData']['payment_due_date'])->format('Y-m-d');
    }
@endphp
<debt-component :config="{{ json_encode($config) }}"></debt-component>
