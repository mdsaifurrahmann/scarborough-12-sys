@props([

    'title' => 'Dashboard',
    'icon' => 'home-outline',
    'attr' => '',

])
<div class="ms-auto d-flex">
    {{ $slot }}
    <div class="btn-group">
        <button type="button" class="btn btn-outline-primary d-flex justify-center align-items-center bread-btn" {!! $attr !!}>
            <ion-icon name="{{ $icon }}"></ion-icon>
            {{ $title }}
        </button>
    </div>
</div>