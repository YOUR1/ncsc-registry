@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Registry')
                    </x-slot>

                    <x-slot name="headerActions">
                        Export as 
                        <x-utils.link
                            class="card-header-action"
                            :href="route('api.export', 'json')"
                            :text="__('JSON')"
                            target="_blank"
                        />
                        |
                        <x-utils.link
                            class="card-header-action"
                            :href="route('api.export', 'wiki')"
                            :text="__('MediaWiki table')"
                            target="_blank"
                        />
                    </x-slot>

                    <x-slot name="body">
                        <livewire:frontend.registration-table />
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
