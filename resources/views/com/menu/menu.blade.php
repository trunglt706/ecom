@foreach ($block as $menu)
    @if(count($menu->submenus))
        <li class="dropdown">
            <a data-toggle="dropdown">
                <span class="tm-label"><?php echo $menu->menu_name ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
                @foreach ($menu->submenus as $submenu)
                <li>
                    <a href="{{ Path::url($menu->lang.'/'.$submenu->alias) }}"><?php echo $submenu->menu_name ?></a>
                </li>
                @endforeach
            </ul>
        </li>
    @else
        <li>
            <a href="{{ Path::url($menu->lang.'/'.$menu->alias) }}">
                <span class="tm-label"><?php echo $menu->icon . $menu->menu_name ?></span>
            </a>
        </li>
    @endif
@endforeach
