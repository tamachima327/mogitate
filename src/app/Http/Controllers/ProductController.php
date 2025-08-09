<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

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
            $this->product = $this->product->where('name', 'like', '%' . $searches['search'] . '%');
        }

        if (!empty($searches['sort'])) {
            if ($searches['sort'] == 'higher') {
                $this->product = $this->product->orderBy('price', 'DESC');
            } elseif ($searches['sort'] == 'lower') {
                $this->product = $this->product->orderBy('price', 'ASC');
            }
        }

        $products = $this->product->paginate(6)->appends($request->query());

        return view('index', compact('products', 'searches'));
    }

    public function show(string $id)
    {
        $product = $this->product->find($id);
        return view('show', compact('product'));
    }

    public function update(ProductRequest $request, string $id)
    {
        $seasons = $request->input('seasons');

        $parameters = $request->only([
            'name',
            'price',
            'description',
        ]);

        $product = $this->product->find($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('public/images');
            $filename = basename($path);
            $parameters['image'] = 'images/' . $filename;
        }

        $product->seasons()->sync($seasons);

        $product->fill($parameters);
        $product->save();

        return redirect()->back()->with('success', '更新が完了しました');
    }

    public function register()
    {
        return view('register');
    }

    public function store(ProductRequest $request)
    {
        $seasons = $request->input('seasons');

        $parameters = $request->only([
            'name',
            'price',
            'description',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('public/images');
            $filename = basename($path);
            $parameters['image'] = 'images/' . $filename;
        }

        $product = $this->product->create($parameters);

        $product->seasons()->attach($seasons);

        return redirect()->route('index')->with('success', '登録が完了しました');
    }

    public function destroy(string $id)
    {
        $product = $this->product->find($id);
        $product->seasons()->detach();
        $product->delete();

        return redirect()->route('index')->with('success', '削除が完了しました');
    }
}
