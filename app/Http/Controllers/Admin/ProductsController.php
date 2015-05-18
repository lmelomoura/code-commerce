<?php namespace CodeCommerce\Http\Controllers\Admin;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

use CodeCommerce\Product;


class ProductsController extends Controller {

	private $products;

    public function __construct(Product $product)
    {
        $this->middleware('guest');
        $this->products = $product;
    }


    public function index()
	{
		$products = $this->products->all();
        return view('products.list',compact('products'));
	}

    public function create()
    {
        return view('products.create');
    }

    public function edit($id)
    {
        $product = $this->products->find($id);
        return view('products.edit',compact('product'));
    }

    public function update(Requests\ProductRequest $request, $id)
    {
        $this->products->find($id)->update($request->all());
        return redirect(route('productsList'));
    }

    public function delete($id)
    {


        $this->products->find($id)->delete();
        return redirect(route('productsList'));
    }

    public function store(Requests\ProductRequest $request)
    {
        $input = $request->all();
        $product = $this->products->fill($input);
        $product->save();
        return redirect(route('productsList'));
    }

}
