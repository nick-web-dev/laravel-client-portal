@props(['title', 'tag', 'text'])

<x-block class="widget-wip bg-wip">
	<div class="wip-content">
		<div class="icon mb-6"><x-icons.data-16x color="url(#blue-grad-90)" /></div>
		<h3 class="mb-3">{{ $title ?? 'WIP' }}</h3>
		<div class="tag bg-yellow-20 rounded px-4 mb-6">{{ $tag ?? 'Data Work In Progress' }}</div>
		<p>{!! e($slot) ?: $text ?? 'This widget is still<br> being developed.' !!}</p>
	</div>
</x-block>