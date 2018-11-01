@foreach ($block as $menu)
    @if(count($menu->submenus))
        <li class="sub-menu">
            <a><i class="zmdi zmdi-layers"></i> <?php echo $menu->menu_name ?></a>
            <ul>
                @foreach ($menu->submenus as $submenu)
                <li><a href="{{ Path::url($menu->lang.'/'.$submenu->alias) }}"><?php echo $submenu->menu_name ?></a></li>
                @endforeach
            </ul>
        </li>
    @else
        <li>
            <a href="{{ Path::url($menu->lang.'/'.$menu->alias) }}"><?php echo $menu->icon . $menu->menu_name ?></a>
        </li>
    @endif
@endforeach
