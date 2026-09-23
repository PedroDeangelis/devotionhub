@props([
    'type',
    'data' => [],
    'mode' => 'view',
    'number' => null,
    'model' => null,
])

{{-- Dispatches to the component for this block type. --}}
<x-dynamic-component
    :component="'blocks.'.str_replace('_', '-', $type instanceof \App\Enums\BlockType ? $type->value : $type)"
    :type="$type instanceof \App\Enums\BlockType ? $type : \App\Enums\BlockType::from($type)"
    :data="$data"
    :mode="$mode"
    :number="$number"
    :model="$model" />
