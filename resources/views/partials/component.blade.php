<li class="list-group-item {{ $component->group_id ? "sub-component" : "component" }}">
    @if($component->link)
    <a href="{{ $component->link }}" target="_blank" class="links">{{ $component->name }}</a>
    @else
    {{ $component->name }}
    @endif

    @if($component->description)
    <i class="ion ion-ios-help-outline help-icon" data-toggle="tooltip" data-title="{{ $component->description }}" data-container="body"></i>
    @endif

    <div class="pull-right">
        <small class="text-component-{{ $component->status }} {{ $component->status_color }}" data-toggle="tooltip" title="{{ trans('cachet.components.last_updated', ['timestamp' => $component->updated_at_formatted]) }}">{{ $component->human_status }}</small>
    </div>

    @if($component->show_sla && $component->acceptable_sla > 0)
        {{-- calculating values for progress bar display --}}
        <?php
        $green_sect_perc = $component->sla / $component->acceptable_sla * 100;
        if ($green_sect_perc < 0) $green_sect_perc = 0; if ($green_sect_perc > 100) $green_sect_perc = 100;
        ?>
        <div class="progress" data-html="true" data-toggle="tooltip" data-title="Current SLA: <b>{{ $component->sla }}</b><br/>Acceptable SLA: <b>{{ $component->acceptable_sla }}</b>" data-container="body">
            <div class="progress-bar progress-bar-success progress-bar-striped" style="width: {{ $green_sect_perc }}%">
                {{ number_format($component->sla, 4, '.', '') }}
            </div>
            <div class="progress-bar progress-bar-danger progress-bar-striped" style="width: {{ (100 - $green_sect_perc) }}%">
            </div>
        </div>
    @endif
</li>
