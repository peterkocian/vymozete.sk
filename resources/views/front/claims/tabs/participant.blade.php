@php
    if($data->getMorphClass() === \App\Models\Person::class) {
        $data['person_type'] = 0;
    }
    elseif($data->getMorphClass() === \App\Models\Organization::class ){
        $data['person_type'] = 1;
    }

    $config = [
        'slug'     => $tab,
        'stepData' => empty(session()->getOldInput()) ? $data : session()->getOldInput(),
        'validationErrors' => $errors->messages(),
        'person_type' => \App\Models\Participant::PERSON_TYPE,
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
