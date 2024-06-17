<?php

namespace App\Livewire\Music;

use App\Models\Music;


use Livewire\Component;


use Livewire\Attributes\On;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

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

    public function deleteSong($musicID)
    {
    }

    public function editSong($musicID)
    {

        $music = Music::find($musicID);
        //Check if $music exists in the database, if not, reload the page
        $musicExists = Music::where('id', $musicID)->exists();
        if (!$musicExists) {
            return redirect()->back();
            exit();
        }

        $this->dispatch(
            'edit-music',
            [
                'passedMusic' => $music,
                'isEditActive' => true
            ]
        );
    }

    public function render()
    {
        return view('livewire.music.music-table');
    }
}
