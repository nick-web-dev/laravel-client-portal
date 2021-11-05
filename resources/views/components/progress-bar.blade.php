@props(['title' => 'Text', 'status' => 0])

@php $status = round($status); @endphp

<div {{ $attributes->merge(['class' => 'progressbar-container text-center']) }}>
    <div class="progressbar-gradient progress-{{ $status }} animated slideInLeft"
    style="width: calc((100% - 70px) * {{ $status / 100  }});">
    </div>
    <p class="font-w500">{{ $title }}</p>
    <div class="bar">
        <div style="width: {{  $status }}%;"></div>
    </div>
    <p class="text-monospace font-w500 mt-4 mb-0">{{ $status }}%</p>
</div>