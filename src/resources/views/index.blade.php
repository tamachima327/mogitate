@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('title')
    商品一覧
@endsection

@section('content')
    <div class="main__header">
        <div class="main__title">
            <h2>@yield('title')</h2>
        </div>
        <div class="main__add-button-container">
            <a href="{{ route('register') }}" class="main__add-button-link">
                <button class="main__add-button">
                        <span class="main__add-button-link-text">+&nbsp;商品を追加</span>
                </button>
            </a>
        </div>
    </div>
    <div class="main__page">
        <div class="main__sidebar">
            <div class="main__sidebar-inner">
                <div class="main__sidebar-search">
                    <div><input class="main__sidebar-search-input" type="text" name="search" placeholder="商品名で検索" /></div>
                    <button class="main__sidebar-search-button" type="submit">検索</button>
                </div>
                <div class="main__sidebar-sort">
                    <h3>価格順で表示</h3>
                    <select name="sort" onchange="changeColor(this)">
                        <option value="" style="display:none;" selected>価格で並び替え</option>
                        <option value="higher">高い順に表示</option>
                        <option value="lower">低い順に表示</option>
                    </select>
                </div>
                <hr />
            </div>
        </div>
        <div class="main__content">
            <div class="main__content-inner">
                @foreach ($products as $product)
                <div class="main__content-item">
                    <div class="main__content-item-inner">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="main__content-item-image">
                        <div class="main__content-item-info">
                            <span class="main__content-item-title">{{ $product->name }}</span>
                            <p class="main__content-item-price">&yen;{{ $product->price }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="main__content-pagination">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        function changeColor(option){
            if( option.value == '' ){
                option.style.color = '#aaa';
            }else{
                option.style.color = '#000';
            }
        }
    </script>
@endsection
