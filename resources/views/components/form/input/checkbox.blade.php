<div class="form-group row">
    <label for="{{ $label ?? $name }}" class="col-md-2 col-form-label">{{ $label ?? ucwords($name) }}</label>
    <div class="col-md-auto">
        <input
            type="checkbox"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value ?? '0' }}"
            class="form-control @error($name) is-invalid @enderror col-sm-12 col-md-auto px-1"
            @if(!!$value) checked @endif
        />
        {{ $slot }}

        @error($name)
        <span class="d-block invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
        @enderror
    </div>
</div>
