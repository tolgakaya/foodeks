<!-- Footer ================================================== -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    @if ($settings!=null)
                    <ul>
                        @if ($settings->facebook !=null)
                        <li><a href="{{$settings->facebook}}"><i class="icon-facebook"></i></a></li>
                        @endif
                        @if ($settings->instagram !=null)
                        <li><a href="{{$settings->instagram}}"><i class="icon-instagram"></i></a></li>
                        @endif
                        @if ($settings->twitter !=null)
                        <li><a href="{{$settings->twitter}}"><i class="icon-twitter"></i></a></li>
                        @endif
                        @if ($settings->youtube !=null)
                        <li><a href="{{$settings->youtube}}"><i class="icon-youtube-play"></i></a></li>
                        @endif
                    </ul>
                    @endif
                    <p>
                        © {{$settings->company ?? 'ADANADAYIM'}} - {{ now()->year }}
                    </p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer>
<!-- End Footer =============================================== -->