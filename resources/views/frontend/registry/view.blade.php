@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang(':NCSC details', ['NCSC' => $advisory->ncsc_id])
                    </x-slot>

                    <x-slot name="body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered mb-0">
                                <tr>
                                    <th width="30%">@lang('ID')</th>
                                    <td>{{ $advisory->ncsc_id }} (<a href="{{ $advisory->url }}" target="_blank">{{ $advisory->url }}</a>)</td>
                                </tr>
                                <tr>
                                    <th>@lang('Description')</th>
                                    <td>{{ $advisory->desc }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Signed PGP')</th>
                                    <td><a href="{{ $advisory->url }}&version=1.04&format=plain" target="_blank">{{ $advisory->url }}&version=1.04&format=plain</a></td>
                                </tr>
                                <tr>
                                    <th>@lang('Change / Damage')</th>
                                    <td>
                                        {{ @getChanceDamageLevel($advisory->chance, $advisory->damage) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('Last updated')</th>
                                    <td>{{ $advisory->updated_at }}</td>
                                </tr>
                            </table>
                        </div><!--table-responsive-->
                    </x-slot>
                </x-frontend.card>

                <hr />

                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Taken actions')
                    </x-slot>
                    <x-slot name="body">
                        <x-forms.patch :action="route('frontend.user.registry.update', $advisory->id)">
                        <div class="table-responsive">
                            @if ( $registration )
                            <div class="alert alert-info">@lang('This advisory has registered actions to it.')</div>
                            @endif
                            <table class="table table-striped table-hover table-bordered mb-0">
                                <tr>
                                    <th>@lang('Impact')</th>
                                    <td>
                                        <select class="impact-templates form-control mb-1 template-selector">
                                            <option value=""></option>
                                            @foreach ( config('feedregistry.actions.message_templates.impact') as $text )
                                                <option>@lang($text)</option>
                                            @endforeach
                                        </select>
                                        <textarea name="impact" class="form-control" placeholder="{{ __('Enter impact or select template above') }}" required>{{ old('impact') ?? $registration->impact }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">@lang('Measure')</th>
                                    <td>
                                        <select class="measure-templates form-control mb-1 template-selector">
                                            <option value=""></option>
                                            @foreach ( config('feedregistry.actions.message_templates.measure') as $text )
                                                <option>@lang($text)</option>
                                            @endforeach
                                        </select>
                                        <textarea name="measure" class="form-control" placeholder="{{ __('Enter measure or select measure template above') }}" required autofocus>{{ old('measure') ?? $registration->measure }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button class="btn btn-sm btn-primary" type="submit">@lang('Publish / Save')</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </x-forms.patch>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->

    <registry-view></registry-view>
@endsection