<?php

namespace App\Livewire\Music;

use App\Models\Music;

use Illuminate\Support\Facades\Storage;

use Livewire\Component;



use Livewire\WithFileUploads;

class MusicTable extends Component
{

    use WithFileUploads;

    public $songcoverimage;
    public $songaudiofile;
    public $songs = [];

    public $music_search = '';

    public function mount()
    {
        $this->songs = Music::all();
    }

    public function updatedMusicSearch($value)
    {
        // If the search value is not empty
        if (!empty($value)) {
            $this->songs = Music::where('song_title', 'LIKE', '%' . $value . '%')
                ->orWhere('song_artist', 'LIKE', '%' . $value . '%')
                ->get();
        } else {
            $this->songs = Music::all();
        }
    }

    public function deleteMusic($musicID)
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



    public function render()
    {
        return view('livewire.music.music-table');
    }
}
