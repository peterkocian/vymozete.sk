@php
    $config = [
        'subtitle' => 'Vy (veriteľ) - zadajte údaje o vás alebo Vašej firme, ktorej má dlžník zaplatiť (vyrovnať neuhradený záväzok).',
        'step' => $step->data(),
        'slug' => $step->slug()
    ];
@endphp
<participant-component :config="{{ json_encode($config) }}"></participant-component>
