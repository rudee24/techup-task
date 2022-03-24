<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Note;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::withCount('notes')->with('notes')
                        ->orderByRaw("FIELD(priority,'High','Medium','Low') ASC")
                        ->orderBy('notes_count','Desc')
                        ->where(function($q) use ($request){
                            if(isset($request->priority)){
                                return $q->where('priority',$request->priority);
                            }
                            if (isset($request->status)) {
                                return $q->where('status', $request->status);
                            }
                            if (isset($request->due_date)) {
                                return $q->where('status', $request->due_date);
                            }
                            if (isset($request->notes)) {
                                return $q->has('notes','>=',$request->notes);
                            }
                        })->get();
        return response()->json($tasks);
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
    public function store(TaskRequest $request)
    {
        $task = new Task;
        $task->subject= $request->subject;
        $task->description=$request->description;
        $task->start_date=$request->start_date;
        $task->due_date = $request->due_date;
        $task->priority=$request->priority;
        $task->status = $request->status;
        $task->save();
        foreach($request['notes'] as $note){
            //print_r($note);
            $nNote = new Note;
            $files=array();
            foreach($note['attachment'] as $attachment){
                $fileName = time() . '.' . $attachment->extension();
                $attachment->move(storage_path('attachments'), $fileName);
                array_push($files,$fileName);
            }
            $nNote->subject=$note['subject'];
            $nNote->note=$note['note'];
            $nNote->attachment=serialize($files);
            $nNote->task_id=$task->id;
            $nNote->save();
        }

        return "Task created successfully";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
