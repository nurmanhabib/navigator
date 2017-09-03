@if ($item->hasChild())
  <!-- No Support Child Menu -->
@else
  @if ($item->isActive())
    <li role="presentation" class="active">
      <a href="#">{{ $item->text }}</a>
    </li>
  @else
    <li role="presentation">
      <a href="{{  $item->url }}">{{ $item->text }}</a>
    </li>
  @endif
@endif
