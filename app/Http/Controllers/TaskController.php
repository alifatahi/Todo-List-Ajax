<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

/**
 * Class TaskController
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *  Home Index
     */
    public function index()
    {
        $tasks = Item::all();
        return view('list', compact('tasks'));
    }

    /**
     *  Create Method
     * @param Request $request
     * @return string
     */
    public function create(Request $request)
    {
        //Create New Task
        $task = new Item;
        $task->task = $request->text;
        $task->save();

        return 'Done';
    }



    public function remove(Request $request)
    {
        Item::where('id',$request->id)->delete();
        return 'Done';
    }
}
