@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pagination.css')}}" />
@endpush

@section('title')
    @if(isset($searches['search']) && $searches['search'] != '')
        "{{ $searches['search'] }}"の商品一覧
    @else
        商品一覧
    @endif
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
                <form id="search-form" method="GET" action="{{ route('search') }}">
                    @csrf
                    <div class="main__sidebar-search">
                        <div><input class="main__sidebar-search-input" type="text" name="search" @if(isset($searches['search'])) value="{{$searches['search']}}" @endif placeholder="商品名で検索" /></div>
                        <input class="main__sidebar-search-button" type="submit" value="検索" />
                    </div>
                    <div class="main__sidebar-sort">
                        <h3>価格順で表示</h3>
                        <select name="sort" onchange="formSubmit(this.value)">
                            <option value="" style="display:none;" @if(isset($searches['sort']) && $searches['sort'] == '') selected @endif>価格で並び替え</option>
                            <option value="higher" @if(isset($searches['sort']) && $searches['sort'] == 'higher') selected @endif>高い順に表示</option>
                            <option value="lower" @if(isset($searches['sort']) && $searches['sort'] == 'lower') selected @endif>低い順に表示</option>
                        </select>
                    </div>
                    @if(isset($searches['sort']) && $searches['sort'] == 'higher')
                    <div class="main__sidebar-sort-list"><span>高い順に表示</span><span class="main__sidebar-sort-icon" onclick="formSubmit('')">+</span></div>
                    @elseif(isset($searches['sort']) && $searches['sort'] == 'lower')
                    <div class="main__sidebar-sort-list"><span>低い順に表示</span><span class="main__sidebar-sort-icon" onclick="formSubmit('')">+</span></div>
                    @endif
                </form>
                <hr />
            </div>
        </div>
        <div class="main__content">
            <div class="main__content-inner">
                @foreach ($products as $product)
                <div class="main__content-item">
                    <a href="{{ route('show', ['productId' => $product->id]) }}">
                        <div class="main__content-item-inner">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="main__content-item-image">
                            <div class="main__content-item-info">
                                <span class="main__content-item-title">{{ $product->name }}</span>
                                <p class="main__content-item-price">&yen;{{ $product->price }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="main__content-pagination">
                {{ $products->links('vendor.pagination.default') }}
            </div>
        </div>
        @if(session('success'))
        <div id="slide-message">{{ session('success') }}</div>
        @endif
    </div>

    <script>
        function formSubmit(sort) {
            const form = document.getElementById('search-form');
            form.sort.value = sort;
            form.submit();
        }

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
