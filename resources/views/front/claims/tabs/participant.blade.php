@php
    if($data->getMorphClass() === \App\Models\Person::class) {
        $data['person_type'] = 0;
    }
    elseif($data->getMorphClass() === \App\Models\Organization::class ){
        $data['person_type'] = 1;
    }

    $config = [
        'slug'     => $tab,
        'stepData' => $data,
        'validationErrors' => $errors->messages(),
        'person_type' => [
            [
                'id' => 0,
                'value' => 'fyzická osoba (nepodnikateľ)'
            ],
            [
                'id' => 1,
                'value' => 'podnikateľ (živnostník, s.r.o., ...)'
            ]
        ],
    ];
    if($data->birthday){
        $config['stepData']['birthday'] = \Carbon\Carbon::parse($data->birthday)->format('Y-m-d');
    }
@endphp
<form action="{{ route('front.claims.'.$tab, $claim_id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <participant-component :config="{{ json_encode($config) }}"></participant-component>
    <div class="group">
        <div class="row">
            <button type="submit" class="big_btn">
                Uložiť
            </button>
        </div>
    </div>
</form>
