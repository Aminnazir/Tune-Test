<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use stdClass;

class CategoryController extends Controller
{


    private function pagination(){

        $pagination = new stdClass();
        $pagination->column = $this->column();
        $pagination->actions = $this->actions();
        $pagination->route = \request()->getRequestUri();
        return   $pagination;
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $data = $this->data($request);
        $pagination = $this->pagination();

        if($request->ajax() || $request->wantsJson())
        {
            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'html' => view('common.paginate',compact('data', 'pagination'))->render(),
            ]);

        }else
        {
            return view('pages.categories.index', compact('data', 'pagination'));
        }
    }


    public function data(Request $request){

        $categories = Category::orderBy('order_level', 'desc');
        //Keyword Search
        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%'.$sort_search.'%');
        }

        $categories = $categories->paginate(15);

        return $categories;
    }

    public function actions(){

        $return =  array(
            array(
                'type' => 'edit',
                'label' => 'Edit',
                'icon' => 'edit',
                'route'=> 'categories.edit',
            ),
            array(
                'type' => 'delete',
                'label' => 'Delete',
                'icon' => 'trash',
                'route'=> 'categories.destroy',
            )
        );

        return json_decode(json_encode($return));
    }
    public function column(){

        $index = 0;
        $column[$index] = new stdClass;
        $column[$index]->data = 'id';
        $column[$index]->title = 'ID';

        $column[++$index] = new stdClass;
        $column[$index]->data = 'name';
        $column[$index]->title = 'Name';
        $column[$index]->render = function ($row){
            return '<span>'.$row->name.'</span>'.($row->parentCategory ? ' <span class="badge bg-label-success">'.$row->parentCategory->name.'</span>' : '');
        };


        $column[++$index] = new stdClass;
        $column[$index]->data = 'Slug';
        $column[$index]->title = 'slug';
        $column[$index]->render = function ($row){
            return '<span>'.$row->slug.'</span>';
        };

        $column[++$index] = new stdClass;
        $column[$index]->data = 'status';
        $column[$index]->title = 'Status';

        $column[++$index] = new stdClass;
        $column[$index]->data = 'action';
        $column[$index]->title = 'Action';


        return $column;

    }
}
