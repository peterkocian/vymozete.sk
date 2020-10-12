@php
    $config = [
        'stepData' => empty(session()->getOldInput()) ? $step->data() : session()->getOldInput(), //todo aj pri ostatnych stepData vs oldInput
        'validationErrors' => $errors->messages(),
        'currencies' => $step->getCurrencies()
    ];
    if($step->data('paymentDueDate')){
        $config['stepData']['paymentDueDate'] = \Carbon\Carbon::parse($config['stepData']['paymentDueDate'])->format('Y-m-d');
    }
@endphp
<debt-component :config="{{ json_encode($config) }}"></debt-component>
