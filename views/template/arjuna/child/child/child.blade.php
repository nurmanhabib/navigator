<li class="treeview">
    <a href="">
        {!! $item->iconFa() !!} <span>{{ $item->text }}</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    
    {!! $child->render() !!}

</li>