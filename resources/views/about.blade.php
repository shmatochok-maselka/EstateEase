@extends('layouts.front')

@section('content')
    <div class="mb-5">
        <div class="slide-one-item home-slider owl-carousel">
            <div>
                <img src="{{ asset('storage/about_us4.jpg')}}" alt="Про Нас" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="site-section site-section-sm bg-light" >
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="site-section-title" style="margin-top: -100px;">
                        <h2>Про Нас</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12" style="margin-top: -100px; margin-bottom: -50px; font-size: 18px">
                    <p> EstateEase – це веб-сайт, що допомагає знайти ідеальне житло на Закарпатті. Наша мета - зробити процес пошуку житла якомога простішим та приємнішим для наших клієнтів. Ми прагнемо забезпечити швидкий та зручний доступ до широкого вибору житла на різний смак та бюджет. З нами ви зможете знайти житло своєї мрії та забезпечити комфортне життя для себе та своєї родини. Оберіть EstateEase - оберіть найкраще житло на Закарпатті!</p>
                    <p>EstateEase - це проект, створений для тих, хто шукає ідеальне житло у Закарпатській області. Як мешканка Закарпаття, я знаю, що цей регіон має багато унікальних та чарівних місць для проживання. Тому метою EstateEase є допомогти людям знайти саме те, що вони шукають, та допомогти зробити процес пошуку якомога зручнішим та простішим. Ми пропонуємо широкий вибір нерухомості на всьому Закарпатті, тож кожен зможе знайти своє ідеальне житло тут, на нашому сайті.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div style="margin-top: 65px">
                        <h5 class="icon-home"> Широкий вибір нерухомості</h5>
                        <p style="margin-top: 15px; font-size: 14px">Ми пропонуємо широкий вибір житла, щоб ви могли знайти саме те, що відповідає вашим потребам та бюджету. </p>
                    </div>
                    <div style="margin-top: 40px">
                        <h5 class="icon-search"> Зручний пошук </h5>
                        <p style="margin-top: 15px; font-size: 14px">Сайт має зручний і простий пошук, який дозволяє вам легко знайти те житло, яке шукаєте саме ви. </p>
                    </div>
                    <div style="margin-top: 40px">
                        <h5 class="icon-question"> Завжди на зв'язку </h5>
                        <p style="margin-top: 15px; font-size: 14px">Якщо у вас виникли якісь питання чи труднощі у виборі житла звертайтесь за нашими контами.</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <img src="{{ asset('storage/about_us6.jpg')}}" alt="Image">
                </div>
            </div>
        </div>
    </div>

@endsection
