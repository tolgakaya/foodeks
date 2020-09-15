@extends('backend/layouts/touchlesssingle')

@section('extracss')

<link href="{{asset('backend/css/style.css')}}" rel="stylesheet" />

<meta name="_token" content="{{csrf_token()}}" />
@endsection
@section('content')

<div class="container-fluid">

    <div class="btn-group" role="group">

        @if ($beforeCategoryId!=null)

        <a class="btn btn-primary"
            href="{{route('touchless.paging',['restaurant'=>1,'category'=>$currentCategoryId,'next'=>0])}}"
            aria-label="Previous">
            <i class="fa fa-angle-left"></i>
            <span>{{$kategoriler[$beforeIndex]->category}}</span>
        </a>

        @endif

        {{-- <a class="btn btn-warning" href="#">{{$kategoriler[$currentIndex]->category}}</a> --}}


        @if ($nextCategoryId!=null)
        <a class="btn btn-primary"
            href="{{route('touchless.paging',['restaurant'=>1,'category'=>$currentCategoryId,'next'=>1])}}"
            aria-label="Next">
            <i class="fa fa-angle-right"></i>
            <span>{{$kategoriler[$nextIndex]->category}}</span>
        </a>
        @endif

    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="snip1492 card shadow">
                <img src="{{asset('backend/img/products/1.jpg')}}" alt="sample85" />
                <div class="figcaption">
                    <div class="options">
                        <div class="dropdown dropdown-options">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i
                                    class="ion-ios-cart">Burası</i></a>
                            <div class="dropdown-menu">
                                <h5>Select an option</h5>
                                <label>
                                    <input type="radio" value="option1" name="options_1" checked>Medium
                                    <span>+ $3.30</span>
                                </label>
                                <label>
                                    <input type="radio" value="option2" name="options_1">Large
                                    <span>+
                                        $5.30</span>
                                </label>
                                <label>
                                    <input type="radio" value="option3" name="options_1">Extra Large
                                    <span>+
                                        $8.30</span>
                                </label>
                                <h5>Add ingredients</h5>
                                <label>
                                    <input type="checkbox" value="">Extra Tomato <span>+
                                        $4.30</span>
                                </label>
                                <label>
                                    <input type="checkbox" value="">Extra Peppers <span>+
                                        $2.50</span>
                                </label>
                                <a href="#0" class="add_to_basket">Add to cart</a>
                            </div>
                        </div>

                    </div>
                    <h3>Camera new</h3>

                    <p>All this modern technology just makes people try to do everything at
                        once.</p>
                    <div class="price">
                        <s>$80.00</s>$78.00
                    </div>
                </div>


                <!-- </div> -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    <p class="text-sm font-weight-500">Copyright 2018 © All Rights
                        Reserved.Dashboard Template</p>
                </div>
            </div>
            <div class="col-xl-6">
                <p class="float-right text-sm font-weight-500"><a href="www.templatespoint.net">Templates Point</a></p>
            </div>
        </div>
    </footer>
    <!-- Footer -->
</div>
@endsection