@php
    $config = [
        'subtitle' => 'Dlžník má voči vám (veriteľovi) dlh (neuhradený záväzok).',
        'stepData' => $step->data(),
        'slug' => $step->slug()
    ];
@endphp
<participant-component :config="{{ json_encode($config) }}"></participant-component>
