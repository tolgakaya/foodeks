<!-- Login modal -->
<div class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
            <form class="popup-form" id="myLogin">
                {{-- {{ csrf_field() }} --}}
                @csrf
                <div class="login_icon"><i class="icon_lock_alt"></i></div>
                <input id="login_email" name="email" type="text"
                    class="form-control form-white @error('email') is-invalid @enderror" placeholder="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                <strong id="email-error"></strong>
                </span>
                <input type="password"
                    class="form-control form-white form-control @error('password') is-invalid @enderror"
                    placeholder="Şifre" id="password" name="password" required autocomplete="current-password">
                <span class="invalid-feedback" role="alert">
                    <strong id="password-error"></strong>
                </span>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Beni hatırla
                            </label>
                        </div>
                    </div>
                </div>
                <div class="text-left">
                    <a href="{{route('password.request')}}">Şifremi unuttum?</a>
                </div>
                <button type="submit" id="btnLogin" class="btn btn-submit">Giriş</button>
            </form>
        </div>
    </div>
</div><!-- End modal -->
<!-- Login modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
            <form class="popup-form" id="myRegister">
                {{ csrf_field() }}
                @csrf
                <div class="login_icon"><i class="icon_lock_alt"></i></div>
                <input id="register_name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="İsminizi giriniz"
                    autofocus>
                <span class="invalid-feedback" role="alert">
                    <strong id="name-error"></strong>
                </span>
                <input id="register_email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="Eposta adresinizi giriniz">
                <span class="invalid-feedback" role="alert">
                    <strong id="email-error"></strong>
                </span>
                <input id="register_password" type="password"
                    class="form-control @error('password') is-invalid @enderror" name="password" required
                    autocomplete="new-password" placeholder="Bir şifre giriniz">
                <span class="invalid-feedback" role="alert">
                    <strong id="password-error"></strong>
                </span>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Şifrenizi tekrar giriniz">
                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                    value="{{ old('mobile') }}" required autocomplete="mobile" placeholder="Telefon giriniz" autofocus>
                <input id="register_city" type="text" class="form-control @error('register_city') is-invalid @enderror"
                    name="mobile" value="{{ old('register_city') }}" required autocomplete="register_city"
                    placeholder="Semtinizi giriniz" autofocus>
                <textarea class="form-control" style="height:150px" placeholder="Adresinzi giriniz" name="notes"
                    id="register_address"></textarea>
                <div class="text-left">
                    <a href="{{route('password.request')}}">Şifrenizi mi unuttunuz?</a>
                </div>
                <button type="submit" id="btnRegister" class="btn btn-submit">Kaydet</button>
            </form>
        </div>
    </div>
</div><!-- End modal -->