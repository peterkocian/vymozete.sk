@php
    $config = [
        'files' => $data,
        'multi' => true
    ];
@endphp
<form action="{{ route('front.claims.uploadDocuments', $claim_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form_box">
        <p></p>
        <upload-component :config="{{ json_encode($config) }}"></upload-component>
        <div class="group">
            <div class="row">
                <button type="submit" class="big_btn">
                    Uložiť
                </button>
            </div>
        </div>
    </div>
</form>
