<ul class="nav nav-pills nav-stacked">
  @foreach ($navigator->getItems() as $item)
    @include ('navigator::bootstrap3.item', compact('item'))
  @endforeach
</ul>
