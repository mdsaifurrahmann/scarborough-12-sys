@props([
    'title' => 'Dashboard',
    'page' => 'eCommerce',
])

<!--start breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{ $title }}</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                        <ion-icon name="home-outline"></ion-icon>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page }}</li>
            </ol>
        </nav>
    </div>

    {{ $slot }}

</div>
<!--end breadcrumb-->
