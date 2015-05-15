<?php namespace CodeCommerce\Http\Controllers\Admin;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;



class CategoriesController extends Controller {

    private $categories;

    public function __construct(Category $category)
    {
        $this->middleware('guest');
        $this->categories = $category;
    }

	public function index()
	{
		$categories = $this->categories->all();
        return view('categories.list',compact('categories'));
	}

	public function create()
	{
        return view('categories.create');
	}

    public function edit($id)
    {
        $category = $this->categories->find($id);
        return view('categories.edit',compact('category'));
    }

    public function update(Requests\CategoryRequest $request, $id)
    {
        $this->categories->find($id)->update($request->all());
        return redirect(route('categoriesList'));
    }

	public function delete($id)
	{
		$this->categories->find($id)->delete();
        return redirect(route('categoriesList'));
	}

    public function store(Requests\CategoryRequest $request)
    {
        $input = $request->all();
        $category = $this->categories->fill($input);
        $category->save();
        return redirect(route('categoriesList'));
    }

}
