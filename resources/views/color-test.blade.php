@extends('layouts.app')

@php
    $colors = [
        'dark-blue',
        'blue',
        'green',
        'red',
        'orange',
        'yellow',
    ];
@endphp

@section('content')
    <div class="content content-narrow pb-20">
        <div class="row">
            @foreach( $colors as $color )
            <div class="col-4">
                <div class="row">
                    <div class="col-6">
                        <h4>{{ ucfirst($color) }}</h4>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-{{ $color }} selected"></div>
                            <div class="pl-6">Selected</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-{{ $color }} active"></div>
                            <div class="pl-6">Active</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-{{ $color }} hover"></div>
                            <div class="pl-6">Hover</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-{{ $color }}"></div>
                            <div class="pl-6">Passive</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-{{ $color }}-20"></div>
                            <div class="pl-6">20%</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-{{ $color }}-10"></div>
                            <div class="pl-6">10%</div>
                        </div>
                        <hr>
                        <div class="btn btn-{{ $color }} btn-default mb-2"> Primary Button </div>
                        <div class="btn btn-{{ $color }} btn-alt mb-2"> Secondary Button </div>
                        <div class="btn btn-{{ $color }} btn-ghost mb-2"> Ghost Button </div>
                    </div>
                    <div class="col-6">
                        <h4>{{ ucfirst($color) }} Gradient</h4>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-gd-{{ $color }} selected"></div>
                            <div class="pl-6">Selected</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-gd-{{ $color }} active"></div>
                            <div class="pl-6">Active</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-gd-{{ $color }} hover"></div>
                            <div class="pl-6">Hover</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-gd-{{ $color }}"></div>
                            <div class="pl-6">Passive</div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-gd-{{ $color }}-light"></div>
                            <div class="pl-6">Gradient {{ ucfirst($color) }} 0% - 30%</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-gd-{{ $color }}-lighter"></div>
                            <div class="pl-6">Gradient {{ ucfirst($color) }} 0% - 20%</div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-gd-{{ $color }}-tertiary"></div>
                            <div class="pl-6">Gradient {{ ucfirst($color) }} 30% - 0% (Tertiary)</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-gd-{{ $color }}-secondary"></div>
                            <div class="pl-6">Gradient {{ ucfirst($color) }} 60% - 10% (Secondary)</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-6 bg-gd-{{ $color }}-primary"></div>
                            <div class="pl-6">Gradient {{ ucfirst($color) }} 90% - 30% (Primary)</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
