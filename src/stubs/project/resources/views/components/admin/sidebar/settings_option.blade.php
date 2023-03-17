@can('settings_view')
    {{--   SETTINGS --}}
    <li class="nav-item @if(request()->route()->named("{$whereIam}.settings.*")) active @endif">
        <a class="nav-link " href="{{route("{$whereIam}.settings.index")}}">
            <i class="fa fa-fw fa-cogs mr-1"></i>
            <span>@lang("admin/settings/settings.sidebar")</span>
        </a>
    </li>
@endif
