@props(['width', 'nodes' => null])

<h3 class="font-bold lg:text-3xl mb-3" style="text-transform: uppercase">{{ __('Nodes monitoring') }}</h3>
@if($nodes != null)
    @foreach($nodes as $node)
        <div class="node flex flex-col mb-3 w-10/12 {{ $width }}">
            <div class="outer-bar-horizontal w-full">
                <span class="inner-bar-horizontal" style="width: {{ $node['load'] }}%"></span>
            </div>
            <span class="text-base">{{ $node['name'] }}</span>
        </div>
    @endforeach
@endif
