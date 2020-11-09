@php
    $config = [
        'files' => $data,
        'validationErrors' => $errors->messages(),
        'multi' => true
    ];
@endphp
<form action="{{ route('front.claims.uploadDocuments', $claim_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form_box">
        <upload-component :config="{{ json_encode($config) }}"></upload-component>
        @error('uploads*')
            <div class="validation-error">{{ $message }}</div>
        @enderror
        <div class="group">
            <div class="row">
                <button type="submit" class="big_btn">
                    Uložiť
                </button>
            </div>
        </div>
    </div>
</form>
