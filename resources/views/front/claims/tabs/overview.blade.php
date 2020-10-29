@php
    $config = [
        'stepData' => $claim,
        'validationErrors' => $errors->messages(),
        'currencies' => $currencies,
        'claimTypes' => $claimTypes
    ];
    if($claim['payment_due_date']){
        $config['stepData']['payment_due_date'] = \Carbon\Carbon::parse($claim['payment_due_date'])->format('Y-m-d');
    }
@endphp
<form action="{{ route('front.claims.updateBaseData', $claim_id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <claim-base-data-component :config="{{ json_encode($config) }}"></claim-base-data-component>
    <div class="group">
        <div class="row">
            <button type="submit" class="big_btn">
                Uložiť
            </button>
        </div>
    </div>
</form>
