@if($component_groups->count() > 0)
@foreach($component_groups as $componentGroup)
<ul class="list-group components">
    @if($componentGroup->enabled_components->count() > 0)
    <li class="list-group-item group-name">
        <i class="{{ $componentGroup->collapse_class }} group-toggle"></i>
        <strong>{{ $componentGroup->name }}</strong>

        <div class="pull-right">
            <i class="ion ion-ios-circle-filled text-component-{{ $componentGroup->lowest_status }} {{ $componentGroup->lowest_status_color }}" data-toggle="tooltip" title="{{ $componentGroup->lowest_human_status }}"></i>
        </div>

        @if($componentGroup->show_sla && $componentGroup->acceptable_sla > 0)
            {{-- calculating values for progress bar display --}}
            <?php
            $green_sect_perc = $componentGroup->sla / $componentGroup->acceptable_sla * 100;
            if ($green_sect_perc < 0) $green_sect_perc = 0; if ($green_sect_perc > 100) $green_sect_perc = 100;
            ?>
            <div class="progress" data-html="true" data-toggle="tooltip" data-title="Current SLA: <b>{{ $componentGroup->sla }}</b><br/>Acceptable SLA: <b>{{ $componentGroup->acceptable_sla }}</b>" data-container="body">
                <div class="progress-bar progress-bar-success progress-bar-striped" style="width: {{ $green_sect_perc }}%">
                    {{ number_format($componentGroup->sla, 4, '.', '') }}
                </div>
                <div class="progress-bar progress-bar-danger progress-bar-striped" style="width: {{ (100 - $green_sect_perc) }}%">
                </div>
            </div>
        @endif
    </li>

    <div class="group-items {{ $componentGroup->is_collapsed ? "hide" : null }}">
        @foreach($componentGroup->enabled_components()->orderBy('order')->get() as $component)
        @include('partials.component', compact($component))
        @endforeach
    </div>
    @endif
</ul>
@endforeach
@endif

@if($ungrouped_components->count() > 0)
<ul class="list-group components">
    <li class="list-group-item group-name">
        <strong>{{ trans('cachet.components.group.other') }}</strong>
    </li>
    @foreach($ungrouped_components as $component)
    @include('partials.component', compact($component))
    @endforeach
</ul>
@endif
