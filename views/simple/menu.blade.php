<ul>
@foreach ($navigator->getItems() as $item)
  @include ('navigator::simple.item', compact('item'))
@endforeach
</ul>
