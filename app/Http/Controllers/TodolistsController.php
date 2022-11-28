<?php

namespace App\Http\Controllers;

use App\Models\todolists;
use Illuminate\Http\Request;

class TodolistsController extends Controller
{
    //READ (GET)
    public function index()
    {
        try {
            $toDoLists = todolists::all();
            return response()->json($toDoLists, 200);
        } catch (\Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }
    //CREATE (POST)
    public function store(Request $request)
    {
        try {
            todolists::create($request->all());
            return response()->json('To Do List created successfully', 201);
        } catch (\Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }
    //UPDATE (PUT)
    public function update(Request $request, int $id)
    {
        try {
            $toDoList = todolists::find($id);
            $toDoList->update($request->all());
            return response()->json('To Do List updated successfully', 201);
        } catch (\Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }
    //DELETE (DELETE)
    public function destroy($id)
    {
        try {
            $toDoList = todolists::find($id);
            $toDoList->delete();
            return response()->json('To Do List deleted successfully', 201);
        } catch (\Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }
}