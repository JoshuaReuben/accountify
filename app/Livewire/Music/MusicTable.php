<?php

namespace App\Livewire\Music;

use App\Models\Music;


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



    public function render()
    {
        return view('livewire.music.music-table');
    }
}
