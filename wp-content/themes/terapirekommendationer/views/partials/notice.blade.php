<div class="{{ $notice['class'] }}">
    @if (isset($notice['icon']))
        <i class="{{ $notice['icon'] }}"></i>
    @endif

        {!! $notice['text'] !!}

    @if (isset($notice['buttons']) && is_array($notice['buttons']))

        @foreach ($notice['buttons'] as $button)
        <a href="{{ $button['url'] }}" class="{{ $button['class'] }}">{{ $button['text'] }}</a>
        @endforeach

    @endif
</div>
