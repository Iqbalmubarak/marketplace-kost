@if ($paginator->hasPages())
<ul class="list-inline list-unstyled">
  @if ($paginator->onFirstPage())
  <li class="prev disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>
  @else
  <li class="prev"><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
  @endif
  @foreach ($elements as $element)
    @if (is_string($element))
    <li class="disabled"><a href="#">{{ $element }}</a></li>
    @endif

    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active"><a href="#">{{ $page }}</a></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
      @endforeach
    @endif
  @endforeach

  @if ($paginator->hasMorePages())
  <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right"></i></a></li>
  @else
  <li class="next disabled"><i class="fa fa-angle-right"></i></li>
  @endif
</ul>
@endif
