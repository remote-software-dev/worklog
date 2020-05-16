<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(){        

        $tasks = Task::orderBy('created_at', 'desc')->paginate(15);      
        // $tasks = DB::table('tasks')->orderBy('created_at', 'desc')->paginate(4);
        $onProgressTasks = Task::where('status', '=', 'On Progress')->orderBy('created_at', 'desc')->get();


        // $news = News::orderBy('created_at', 'desc')->paginate(4);
		// $slider = DB::table('news')->take(3)->orderBy('created_at', 'desc')->get();
                
       
        // $totalTask = DB::table('tasks')
        //     ->select(DB::raw('COUNT(id) as totalTask'))
        //     ->where(DB::raw('DATE(created_at)'), '=', $date)
        //     ->groupBy(DB::raw('CAST(created_at as date)'))
        //     ->get();
    // https://stackoverflow.com/questions/29548073/laravel-advanced-wheres-how-to-pass-variable-into-function
    // https://stackoverflow.com/questions/14179758/how-can-i-build-a-condition-based-query-in-laravel
        // return view('dashboard', compact('tasks', 'totalTask'));                  /\
        return view('dashboard', compact('tasks', 'onProgressTasks'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create($request->input());
        return response()->json($task);
    }

    /**splay the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->time = $request->time;
        $task->requester = $request->requester;
        $task->issue = $request->issue;
        $task->comment = $request->comment;
        $task->doneBy = $request->doneBy;
        $task->status = $request->status;

        $task->save();
        return response()->json($task);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::destroy($id);
        return response()->json($id);
    }

}
