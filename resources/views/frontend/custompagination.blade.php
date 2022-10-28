<style>
    .page-item.active .page-link{
        z-index: 3;
        color: #fff !important  ;
        background-color: #00ACD6 !important;
        border-color: #00ACD6 !important;
        border-radius: 50%;
        padding: 6px 12px;
    }
    /* .page-link{
        z-index: 3;
        color: #00ACD6 !important;
        background-color: #fff;
        border-color: #007bff;
        border-radius: 50%;
        padding: 6px 12px !important;
    }
    .page-item:first-child .page-link{
        border-radius: 30% !important;
    }
    .page-item:last-child .page-link{
        border-radius: 30% !important;
    }
    .pagination li{
        padding: 3px;
    }
    .disabled .page-link{
        color: #212529 !important;
        opacity: 0.5 !important;
    } */
</style>
{{-- @if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">{{ $element }}</li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>
        @endif
    </ul>
@endif --}}

{{-- brake --}}

@if ($paginator->hasPages())
<ul class="pagination_nav">

    {{-- <li class="active"><a href="#!">01</a></li>
    <li><a href="#!">02</a></li>
    <li><a href="#!">03</a></li> --}}
    @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">{{ $element }}</li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{-- <li class="page-item active">
                            <a class="page-link">{{ $page }}</a>
                        </li> --}}
                        <li class="page-item active">
                            <a>{{$page}}</a>
                        </li>
                    @else
                        {{-- <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li> --}}
                        <li class="page-item ">
                            <a href="{{$url}}">{{$page}}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
    @if ($paginator->onFirstPage())
        <li class="prev_btn">
            <a href="#"><i class="fal fa-angle-left"></i></a>
        </li>
    @else
        <li class="prev_btn">
            <a href="{{ $paginator->previousPageUrl() }}"><i class="fal fa-angle-left"></i></a>
        </li>
    @endif

    @if ($paginator->hasMorePages())
        <li class="next_btn">
            <a href="{{ $paginator->nextPageUrl() }}"><i class="fal fa-angle-right"></i></a>
        </li>
    @else
        <li class="next_btn">
            <a href="#"><i class="fal fa-angle-right"></i></a>
        </li>
    @endif

</ul>

@endif
