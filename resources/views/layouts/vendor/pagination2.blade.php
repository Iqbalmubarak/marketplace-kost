@if ($paginator->hasPages())
<ul role="menu" class="dropdown-menu">
    @foreach ($elements as $element)
      @if (is_string($element))
      <li role="presentation" class="disabled"><a href="#">{{ $element }}</a></li>
      @endif

      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
          <li role="presentation"><a href="#">{{ $page }}</a></li>
          @else
          <li role="presentation"><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
      @endif
    @endforeach
</ul>
@endif
