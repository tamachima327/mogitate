<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $searches = [
            'search' => '',
            'sort' => '',
        ];
        $products = $this->product->paginate(6);
        return view('index', compact('products', 'searches'));
    }

    public function search(SearchRequest $request)
    {
        $searches = $request->only([
            'search',
            'sort',
        ]);

        if (!empty($searches['search'])) {
            Log::debug('aaa');
            $this->product = $this->product->where('name', 'like', '%' . $searches['search'] . '%');
        }

        if (!empty($searches['sort'])) {
            if ($searches['sort'] == 'higher') {
                $this->product = $this->product->orderBy('price', 'DESC');
            } elseif ($searches['sort'] == 'lower') {
                $this->product = $this->product->orderBy('price', 'ASC');
            }
        }

        $products = $this->product->paginate(6);

        return view('index', compact('products', 'searches'));
    }
}
