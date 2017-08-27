@if ($item->hasChild())
  @if ($item->child->hasActive())
    <li>
      <strong><a href="{{ $item->url }}">{{ $item->text }}</a></strong>
      {!! $item->child->render(new \Nurmanhabib\Navigator\NavRender\NavSimple) !!}
    </li>
  @else
    <li>
      <a href="{{ $item->url }}">{{ $item->text }}</a>
      {!! $item->child->render(new \Nurmanhabib\Navigator\NavRender\NavSimple) !!}
    </li>
  @endif
@else
  @if ($item->isActive())
    <li><strong><a href="{{ $item->url }}">{{ $item->text }}</a></strong></li>
  @else
    <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
  @endif
@endif
