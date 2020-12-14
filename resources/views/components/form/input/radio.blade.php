<div class="form-group row">
    <label class="col-md-2 col-form-label">{{ $label ?? ucfirst($name) }}</label>
    <div class="col-md-auto form-check-inline float-left ml-3">
        @foreach($options as $index => $option)
            <input
                type="radio"
                id="{{ $option }}"
                name="{{ $name }}"
                value="{{ $optionsKey ? $option->$optionsKey : $option }}"
                class="form-control form-check-input @error($name) is-invalid @enderror"
                @if($optionsKey && $optionsLabel)
                    @if($option === $value) checked @endif
                @else
                    @if($option === $value) checked @endif
                @endif
            />
            <label for="{{ $name.$index }}" class="col-form-label form-check-label col-auto mr-4">{{ ucwords($option) }}</label>
        @endforeach
        {{ $slot }}

        @error($name)
        <span class="d-block invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
        @enderror
    </div>
</div>
