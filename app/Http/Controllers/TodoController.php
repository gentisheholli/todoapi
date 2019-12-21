<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TodoRequest;
use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $countStatus1=0;
        $countStatus2=0;
        $countStatus3=0;
        $all_tasks_completed = false;

        $tasks = Todo::all();
        if($tasks->isEmpty()){
            return response()->json(['msg'=> 'The todo list is empty','data'=> '' ]);
        }
        else{
            foreach($tasks as $task){
                if($task->status==1){
                    $countStatus1++;
                }
                if($task->status==2){
                    $countStatus2++;
                }

                else{
                    $countStatus3++;
                }

            }
            
            if($countStatus1==0 && $countStatus2==0 && !$countStatus3=0){
                $all_tasks_completed = true;
            }
            else{
                $all_tasks_completed = false;
            }
            return response()->json(['tasks:'=> $task, 'All tasks completed:'=> $all_tasks_completed, 'username:'=>auth()->user()->name]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
       $task = Todo::create($request->all());
        return response()->json(['msg'=> 'Task created succesfully','data'=> $task]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Todo::findOrFail($id);
        return response()->json(['data'=> $task]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Todo::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'due_date' => 'required',
            'status' => 'required',
        ]);
         
        $update = ['name' => $request->name, 'due_date' => $request->due_date, 'status' => $request->status];
        $task->update($update);
   
        return response()->json(['msg'=> 'Task updated succesfully','data'=> $task]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Todo::where('id',$id)->delete();
        return response()->json(['msg'=>'Task deleted succesfully','data'=> $task]);
    }
}
