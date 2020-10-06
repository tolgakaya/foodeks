<div class="cd-cart  js-cd-cart {{$quantity > 0 ? 'goster' : 'gizle'}}">
    <a href="#0" class="cd-cart__trigger text-replace">
        Cart
        <ul class="cd-cart__count">
            <!-- cart items count -->
            <li id='quantity'>{{$quantity}}</li>
            <li>0</li>
        </ul> <!-- .cd-cart__count -->
    </a>

    <div class="cd-cart__content">
        <div class="cd-cart__layout">
            <header class="cd-cart__header">
                <h3>Siparişiniz</h3><i class="icon_cart_alt"></i>

            </header>

            <div class="cd-cart__body">

                <div class="table table-responsive" id="cart_box">

                    <table class="table table_summary">
                        <tbody id="cd_cartbody" class="cartbody">
                            @foreach($cartItems as $rowid => $row)
                            <tr class="info">
                                <td>
                                    <a href="#0" class="remove_item" id="{{$row->id}}"><i
                                            class="icon_minus_alt"></i></a>
                                    <strong>{{$row->quantity}}X</strong>
                                    @if($row->attributes['option']!==null)

                                    <strong>{{$row->attributes['option']->option}}</strong>

                                    @endif
                                    {{$row->name}}
                                </td>
                                <td>
                                    @if($row->attributes['option']!==null)
                                    <strong
                                        class="pull-right">{{ $row->quantity * ($row->price + $row->attributes['option']->fee)}}
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
                </div><!-- End cart_box -->
            </div>

            <footer class="cd-cart__footer mycart-footer">
                @if($restaurant !=null)
                <a href="{{$restaurant->isAvailable()== true ? route('orders.create') : '#'}}"
                    class="cd-cart__checkout">
                    <em>Toplam <span
                            class="total">{{$restaurant->isAvailable()== false ? 'Servis Zamanı Dışında' : $total}}
                            TL</span>
                        <svg class="icon icon--sm" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor">
                                <line stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x1="3" y1="12"
                                    x2="21" y2="12" />
                                <polyline stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    points="15,6 21,12 15,18 " />
                            </g>
                        </svg>
                    </em>
                </a>
                @endif

            </footer>
        </div>
    </div> <!-- .cd-cart__content -->
</div> <!-- cd-cart -->