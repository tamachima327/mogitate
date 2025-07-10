@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pagination.css')}}" />
@endpush

@section('title')
    "{{ $product->name }}"の商品詳細
@endsection

@section('content')
    <div class="main__page">
        <div class="main__header">
            <div class="main__breadcrumb">
                <a href="{{ route('index') }}">商品一覧</a>&nbsp;>&nbsp;{{ $product->name }}
            </div>
        </div>
        <div class="main__content">
            <div class="main__content-inner">
                <form id="register-form" method="POST" action="{{ route('update', ['productId' => $product->id]) }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="main__form-content">
                        <div class="main__form-upper-content">
                            <div class="main__form-image-container">
                                <img id="product-image" src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="main__form-image" />
                                <div class="main__form-image-upload">
                                    <input type="file" id="image" name="image" />
                                    @error('image')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="main__form-input-container">
                                <div class="main__form-name-container">
                                    <div class="input-title margin-0">商品名</div>
                                    <input type="text" id="name" name="name" placeholder="商品名" value="{{ $product->name }}" />
                                    @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="main__form-price-container">
                                    <div class="input-title">値段</div>
                                    <input type="number" id="price" name="price" placeholder="値段" value="{{ $product->price }}" />
                                    @error('price')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="main__form-season-container">
                                    <div class="input-title">季節</div>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" id="spring" name="seasons[]" value="1" @if($product->seasons->contains('id', 1)) checked @endif />
                                        <span class="checkmark"></span>
                                        春
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" id="summer" name="seasons[]" value="2" @if($product->seasons->contains('id', 2)) checked @endif />
                                        <span class="checkmark"></span>
                                        夏
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" id="autumn" name="seasons[]" value="3" @if($product->seasons->contains('id', 3)) checked @endif />
                                        <span class="checkmark"></span>
                                        秋
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" id="winter" name="seasons[]" value="4" @if($product->seasons->contains('id', 4)) checked @endif />
                                        <span class="checkmark"></span>
                                        冬
                                    </label>
                                    @error('seasons')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="main__form-lower-content">
                            <div class="main__form-description-container">
                                <div>商品説明</div>
                                <textarea id="description" name="description" placeholder="商品説明">{{ $product->description }}</textarea>
                                @error('description')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="main__form-button-container clearfix">
                        <div class="main__form-button-inner">
                            <button><a href="{{ route('index') }}">戻る</a></button>
                            <input type="submit" value="変更を保存" />
                        </div>
                        <span class="material-symbols-outlined trash-icon" onclick="deleteProduct()">delete</span>
                    </div>
                </form>
                <form id="delete-form" method="POST" action="{{ route('destroy', ['productId' => $product->id]) }}">
                    @csrf
                    @method('DELETE')
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

        function deleteProduct() {
            const form = document.getElementById('delete-form');
            form.submit();
        }
    </script>
@endsection
