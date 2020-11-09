@php
    $config = [
        'subtitle' => 'Vy (veriteľ) - zadajte údaje o vás alebo Vašej firme, ktorej má dlžník zaplatiť (vyrovnať neuhradený záväzok).',
        'stepData' => empty(session()->getOldInput()) ? $step->data() : session()->getOldInput(),
        'slug' => $step->slug(),
        'validationErrors' => $errors->messages(),
        'person_type' => \App\Models\Participant::PERSON_TYPE,
    ];
    if($step->data('birthday')){
        $config['stepData']['birthday'] = \Carbon\Carbon::parse($step->data('birthday'))->format('Y-m-d');
    }
@endphp
<participant-component :config="{{ json_encode($config) }}"></participant-component>
