@if ($item->hasChild())
  @if ($item->child->hasActive())
    <li class="active">
      <a href="#" class="has-arrow" aria-expanded="true">{{ $item->text }}</a>
      <ul aria-expanded="true">
        @foreach ($item->child->getItems() as $item)
          @include ('navigator::metis-menu.item', compact('$item'))
        @endforeach
      </ul>
    </li>
  @else
    <li>
      <a href="#" class="has-arrow" aria-expanded="false">{{ $item->text }}</a>
      <ul aria-expanded="false">
        @foreach ($item->child->getItems() as $item)
          @include ('navigator::metis-menu.item', compact('$item'))
        @endforeach
      </ul>
    </li>
  @endif
@else
  @if ($item->isActive())
    <li class="active"><a href="{{ $item->url }}">{{ $item->text }}</a></li>
  @else
    <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
  @endif
@endif
