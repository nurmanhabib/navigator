<ul class="metismenu" id="{{ $id }}">
  @foreach ($navigator->getItems() as $item)
    @include ('navigator::metis-menu.item', compact('$item'))
  @endforeach
</ul>
