<div class="theiaStickySidebar">
    <div class="table table-responsive" id="cart_box">
        <h3>Siparişiniz<i class="icon_cart_alt pull-right"></i></h3>
        <table class="table table_summary">
            <tbody id="cartbody" class="cartbody">
                @foreach($cartItems as $rowid => $row)
                <tr style="background: #ccc">
                    <td>
                        <a href="#0" class="remove_item" id="{{$row->id}}"><i class="icon_minus_alt"
                                style="color: #db1919"></i></a>
                        <strong>{{$row->quantity}}X</strong>
                        @if($row->attributes['option']!==null)

                        <strong>{{$row->attributes['option']->option}}</strong>

                        @endif
                        {{$row->name}}
                    </td>
                    <td>
                        @if($row->attributes['option']!==null)
                        <strong class="pull-right">{{ $row->quantity * ($row->price + $row->attributes['option']->fee)}}
                            TL</strong>
                        @else
                        <strong class="pull-right">{{$row->quantity * $row->price}} TL</strong>
                        @endif
                    </td>

                </tr>
                @foreach($row->attributes['extras'] as $key => $extra)
                <tr>

                    <td class="pull-right">
                        {{-- <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> --}}
                        <strong>Ekstra </strong>
                        {{$extra->extra}}
                    </td>
                    <td>
                        <strong class="pull-right">{{$extra->fee}}</strong>
                    </td>

                </tr>
                @endforeach

                @endforeach
            </tbody>
        </table>
        <hr>
        <hr>

        <table class="table table_summary">
            <tbody>
                <tr>
                    <td class="totalsabit">
                        TOPLAM <span class="pull-right">{{$total}} TL</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        {{-- @if ($restaurant !=null) --}}
        <a class="btn_full"
            href="{{$restaurantMenu->isAvailable()== true ? route('orders.create') : '#'}}">{{$restaurantMenu->isAvailable()== false ? 'Servis Zamanı Dışında' : 'Sipariş Ver'}}</a>
        {{-- @endif --}}

    </div><!-- End cart_box -->
</div><!-- End theiaStickySidebar -->