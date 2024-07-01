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

        Lesson::create([
            'module_id' => $moduleID,
            'lesson_title' => $lesson_title,
            'lesson_content' => $lesson_content
        ]);

        //set session temporarily
        session(['success-msg-on-lesson' => 'You have successfully created a new Lesson.']);

        // $redirectUrl = url('/admin/courses/show/' . $courseID); // Adjust the path as needed
        $redirectUrl = route('pages.admin.course.show', ['courseID' => $courseID]); // Adjust the path as needed

        return response()->json([
            'message' => 'Success, Contents Saved Successfully.',
            'redirect_url' => $redirectUrl
        ]);
    }
}
