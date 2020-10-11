<div id="filters_col">
    {{-- @if (count($ads)>0) --}}
    @if (isset($adds))
    <div class="filter_type">
        <img src="{{$adds->filename !=null ? 'images/'+$adds->filename : asset('frontend/img/reklam-durum.gif')}}"
            alt="">
    </div>
    <br>
    <br>
    @else
    <div class="filter_type">
        <img src="{{$adds->filename !=null ? 'images/'+$adds->filename : asset('frontend/img/reklam-durum.gif')}}"
            alt="">
    </div>
    <br>
    <br>
    @endif



    {{-- @endif --}}
</div>