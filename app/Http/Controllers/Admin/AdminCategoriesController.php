<?php namespace CodeCommerce\Http\Controllers\Admin;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminCategoriesController extends Controller {

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
		//
	}

    public function request($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

	public function delete($id)
	{
		//
	}

}
