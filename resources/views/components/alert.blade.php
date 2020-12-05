@php
    $uniqid = uniqid()
@endphp

<div id="{{ $uniqid }}" {{ $attributes->merge(['class' => 'alert alert-' . $type]) }}>
    {{ $message }}
</div>

<script>
    var myid = "#{{ $uniqid }}", delay = 1;
    setTimeout(function(){
        slideFade($(myid));
    }, 3000);

    const slideFade = (elem) => {
        const fade = { opacity: 0, transition: 'opacity ' + delay + 's' };
        elem.css(fade).slideUp(delay * 1000);
    }
</script>
