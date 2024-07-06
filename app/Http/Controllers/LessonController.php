<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function store(Request $request)
    {
        $lesson_title = $request->input('lesson_title');
        $lesson_content = $request->input('lesson_content');
        $courseID = $request->input('courseID');
        $moduleID = $request->input('moduleID');

        $lesson = Lesson::create([
            'module_id' => $moduleID,
            'lesson_title' => $lesson_title,
            'lesson_content' => $lesson_content
        ]);

        session(['message' => 'You have successfully created a new Lesson.']);

        $redirectUrl = route('pages.admin.lesson.show', ['courseID' => $courseID, 'moduleID' => $moduleID, 'lessonID' => $lesson->id]);

        return response()->json([
            'message' => 'Success, Contents Saved Successfully.',
            'redirect_url' => $redirectUrl
        ]);
    }

    public function retrieve(Request $request)
    {
        $lessonID = $request->input('lessonID');
        $lesson = Lesson::find($lessonID);

        return response()->json([
            'lesson_content' => $lesson->lesson_content
        ]);
    }

    public function update(Request $request)
    {
        $courseID = $request->input('courseID');
        $moduleID = $request->input('moduleID');
        $lessonID = $request->input('lessonID');
        $lesson_title = $request->input('lesson_title');
        $lesson_content = $request->input('lesson_content');

        $lesson = Lesson::find($lessonID);
        $lesson->update([
            'lesson_title' => $lesson_title,
            'lesson_content' => $lesson_content
        ]);

        session(['message' => 'You have successfully updated a Lesson.']);

        $redirectUrl = route('pages.admin.lesson.show', ['courseID' => $courseID, 'moduleID' => $moduleID, 'lessonID' => $lessonID]); // Adjust the path as needed

        return response()->json([
            'message' => 'Success, Contents Updated Successfully.',
            'redirect_url' => $redirectUrl
        ]);
    }
}
