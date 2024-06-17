<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $musicID)
    {
        $passedMusic = Music::find($musicID);

        return view('pages.admin.music-edit', ['passedMusic' => $passedMusic]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $musicID)
    {
        $music = Music::find($musicID);

        //Check if $music exists in the database, if not, reload the page
        $musicExists = Music::where('id', $musicID)->exists();
        if (!$musicExists) {
            return redirect()->back();
            exit();
        }

        //Optional turn this into job for async processing
        $fileExists = Storage::exists('public/' . $music->song_file_path);
        // dd($fileExists);
        if ($fileExists) {
            Storage::delete('public/' . $music->song_cover_photo);
            Storage::delete('public/' . $music->song_file_path);
        } else {
            //reload the browser
            return redirect()->back();
            exit();
        }

        $music->delete();
        // $this->dispatch('reload-page');
        return redirect()->route('pages.admin.music')->with('message', 'Music Deleted Successfully');
    }
}
