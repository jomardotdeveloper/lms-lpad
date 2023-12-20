@if (isset($breadcrumbs))
<nav>
    <ul class="breadcrumb breadcrumb-arrow">
        @php
            $lastItem = end($breadcrumbs);
        @endphp
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb == $lastItem)
                <li class="breadcrumb-item active">{{ $breadcrumb['name'] }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['name'] }}</a></li>
            @endif
        @endforeach
    </ul>
</nav>
@endif

