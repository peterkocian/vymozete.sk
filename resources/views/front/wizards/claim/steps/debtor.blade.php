@php
    $config = [
        'subtitle' => 'Dlžník má voči vám (veriteľovi) dlh (neuhradený záväzok).',
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
