@csrf

<div class="form-group row">
    <label for="body" class="col-md-2 col-form-label text-md-right">{{ __('Body') }}</label>

    <div class="col-md-10">
        <input id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ $status->body }}" required autofocus>

        @error('body')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <p class="col-md-2 col-form-label text-md-right">{{ __('Tags') }}</p>

    <div class="col-md-10">
        <tag-component :value="{{ json_encode($status->tags) }}" :tags="{{ json_encode($tags) }}"/>
    </div>
</div>


<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ $buttonText }}
        </button>
    </div>
</div>