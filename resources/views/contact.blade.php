@extends('layouts.front')

@section('content')
    <div class="site-section site-section-sm bg-light">
        <div class="container" style="margin-bottom: -100px">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="site-section-title" style="margin-top: -50px; color: #1d2124; font-size: 20px">
                        <p><h2>Маєте якісь питання?</h2></p>
                        <p><h2>Зв'яжіться з нами!</h2></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div style="margin-top: 100px">
                    <h5 class="fas fa-map-marker-alt" style="color: #4e555b">  Адреса </h5>
                    <p>вул. Чопська, 25, м. Ужгород</p>
                </div>
                <div style="margin-top: 30px">
                    <h5 class="fas fa-phone"  style="color: #4e555b">  Номер телефону </h5>
                    <p>Зателефонуйте нам +380123456789</p>
                </div>
                <div style="margin-top: 30px">
                    <a href="mailto:real_ease@gmail.com" style="color: #4e555b">
                        <h5 class="fas fa-envelope"> Електронна пошта </h5></a>
                    <p>Напишіть нам на електронну скриньку estate_ease@gmail.com.</p>
                </div>
            </div>
            <div class="col-md-8" style="margin-top: 50px; margin-bottom: 50px">
                <img src="{{ asset('storage/about_us7.jpg')}}" alt="Image">
            </div>
        </div>
    </div>
@endsection
