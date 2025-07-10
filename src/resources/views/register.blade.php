@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pagination.css')}}" />
@endpush

@section('title')
    商品登録
@endsection

@section('content')
    <div class="main__page">
        <div class="main__content">
            <div class="main__content-inner">
                <form id="register-form" method="POST" action="{{ route('store') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="main__form-content">
                        <div class="main__form-title">
                            <h2>@yield('title')</h2>
                        </div>
                        <div class="main__form-name-container">
                            <div class="input-title">商品名<span class="required-box">必須</span></div>
                            <input type="text" id="name" name="name" placeholder="商品名" value="{{ old('name') }}" />
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="main__form-price-container">
                            <div class="input-title">値段<span class="required-box">必須</span></div>
                            <input type="number" id="price" name="price" placeholder="値段" value="{{ old('price') }}" />
                            @error('price')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="main__form-image-container">
                            <div class="input-title">商品画像<span class="required-box">必須</span></div>
                            <img id="product-image" src="" alt="商品画像" class="main__form-image" />
                            <div class="main__form-image-upload">
                                <input type="file" id="image" name="image" />
                                @error('image')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="main__form-season-container">
                            <div class="input-title">季節<span class="required-box">必須</span><span class="red">複数選択可</span></div>
                            <label class="custom-checkbox">
                                <input type="checkbox" id="spring" name="seasons[]" value="1" @if(in_array(1, old('seasons', []))) checked @endif />
                                <span class="checkmark"></span>
                                春
                            </label>
                            <label class="custom-checkbox">
                                <input type="checkbox" id="summer" name="seasons[]" value="2"  @if(in_array(2, old('seasons', []))) checked @endif />
                                <span class="checkmark"></span>
                                夏
                            </label>
                            <label class="custom-checkbox">
                                <input type="checkbox" id="autumn" name="seasons[]" value="3"  @if(in_array(3, old('seasons', []))) checked @endif />
                                <span class="checkmark"></span>
                                秋
                            </label>
                            <label class="custom-checkbox">
                                <input type="checkbox" id="winter" name="seasons[]" value="4"  @if(in_array(4, old('seasons', []))) checked @endif />
                                <span class="checkmark"></span>
                                冬
                            </label>
                            @error('seasons')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="main__form-description-container">
                            <div class="input-title">商品説明<span class="required-box">必須</span></div>
                            <textarea id="description" name="description" placeholder="商品説明">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="main__form-button-container clearfix">
                        <div class="main__form-button-inner">
                            <button><a href="{{ route('index') }}">戻る</a></button>
                            <input type="submit" value="登録" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(session('success'))
        <div id="slide-message">{{ session('success') }}</div>
        @endif
    </div>

    <script>
        const image = document.getElementById('image');
        image.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            const productImage = document.getElementById('product-image');
            reader.addEventListener('load', function() {
                productImage.src = reader.result;
                productImage.style.display = 'inline';
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        @if(session('success'))
        const msg = document.getElementById('slide-message');
        setTimeout(() => {
            msg.classList.add('show');
        }, 100);
        setTimeout(() => {
        msg.classList.remove('show');
        }, 5100);
        setTimeout(() => {
        msg.style.display = 'none';
        }, 5600);
        @endif
    </script>
@endsection
