<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function store(Request $request)
    {
        $lesson_title = $request->input('lesson_title');
        $lesson_content = $request->input('lesson_content');
        return response()->json(['message' => 'Success, Conents Stored.']);
    }
}
