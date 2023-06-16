<x-livewire-tables::bs4.table.cell>
    <x-utils.link
        :href="route('frontend.user.registry.view', $row->id)"
        :text="$row->ncsc_id" />
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->title }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->version }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
@if ( $row->registration_id === null )
    <span class="badge badge-danger p-2">@lang('No')</span>
@else
<span class="badge badge-success p-2">@lang('Yes')</span>
@endif
</x-livewire-tables::bs4.table.cell>