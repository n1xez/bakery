<div class="content">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><i class="fas fa-tv"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('shops*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('shops.index') }}">ПЕКАРНИ</a>
                </li>
                <li class="nav-item {{ Request::is('products*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('products.index') }}">ПРОДУКЦИЯ</a>
                </li>
                <li class="nav-item {{ Request::is('assortments*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('assortments.index') }}">АССОРТИМЕНТ</a>
                </li>
                <li class="nav-item {{ Request::is('report*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('report') }}">ОТЧЕТ</a>
                </li>
            </ul>
            @include('layouts.login')
        </div>
    </nav>
</div>