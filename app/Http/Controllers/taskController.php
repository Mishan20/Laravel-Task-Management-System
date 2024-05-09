<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use Illuminate\Http\Request;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $rules = [ // Define custom validation rules (optional)
            // "employee_id" => "required|integer|exists:users,id", // Ensure user exists
            // "name" => "required|string|max:255",
        ];

        $validator = Validator::make($request->all(), $rules); // Validate data

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // Return validation errors
        }

        try {
            $task = new Task;
            $task->employee_id = $request->employee_id;
            $task->title = $request->title;
            $task->description = $request->description;
            $task->date = $request->date;
            $task->time = $request->time;
            $task->status = $request->status;
            $task->save(); // Save the task

            return response()->json([
                'message' => 'Task created successfully!',
                'data' => $task->with('employee')->first(), // Load user data if needed
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating task: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::find($id);
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
        $task = Task::find($id);
        $task->update($request->all());
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Task::destroy($id);
    }


    /**
     * Search the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Task::where('title', 'like', '%'.$name.'%')->get();
    }
}
