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

    /**
     *  Update method
     * @param Request $request
     */
    public function update(Request $request)
    {
        // Find Item & Update
        $task = Item::findOrFail($request->id);
        $task->task = $request->value;
        $task->save();
    }


    /**
     *  Delete Method
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function remove(Request $request)
    {
        // Find Item and Remove it
        Item::where('id', $request->id)->delete();
        return 'Done';
    }


    /**
     *  Ajax Search
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {
        //Get Result
        $term = $request->term;
        //Query For Search
        $tasks = Item::where('task', 'LIKE', '%' . $term . '%')->get();
        //Check Count
        if (count($tasks) == 0) {
            // Make Result as Array
            $result[] = 'No Item Found';
        } else {
            foreach ($tasks as $key => $value) {
                $result[] = $value->task;
            }
        }

        return $result;
    }
}
