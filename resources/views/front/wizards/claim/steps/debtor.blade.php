@php
    $config = [
        'subtitle' => 'Dlžník má voči vám (veriteľovi) dlh (neuhradený záväzok).',
        'stepData' => $step->data(),
        'slug' => $step->slug(),
        'validationErrors' => $errors->messages(),
        'oldInputs' => session()->getOldInput(),
        'personType' => [
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
    if($step->data('birthday')){
        $config['stepData']['birthday'] = \Carbon\Carbon::parse($config['stepData']['birthday'])->format('Y-m-d');
    }
@endphp
<participant-component :config="{{ json_encode($config) }}"></participant-component>
