@extends('backend.layouts.app')

@section('title', __('Registration'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Registration management')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.advisories-table />
        </x-slot>
    </x-backend.card>
@endsection
