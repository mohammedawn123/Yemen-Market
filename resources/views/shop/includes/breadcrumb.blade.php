
@if(Session('breadcrumbs'))
        <nav id="breadcrumb">
            <ul class="breadcrumb" style="background-color: #fff; border: 0px;">
                    @foreach ( Session('breadcrumbs')['breadcrumbs'] as $breadcrumbs )
                        <li><a href="{{ route($breadcrumbs['href']) }}">  {!!  $breadcrumbs['text'] !!} </a></li>
                    @endforeach
                </ul>
        </nav>
@endif
