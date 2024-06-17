<?php

namespace App\Livewire\Music;

use App\Models\Music;
use Livewire\Livewire;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class MusicEdit extends Component
{

    use WithFileUploads;

    public $passedMusic;
    public $isEditActive = false;
    public $songtitle = '';
    public $songartist = '';
    public $songcoverimage;
    public $songaudiofile;


    #[On('edit-music')]
    public function receiveMusic(Music $music)
    {
        $this->passedMusic = $music;
        $this->songtitle = $music->song_title;
        $this->songartist = $music->song_artist;
        $this->songcoverimage = $music->song_cover_photo;
        $this->songaudiofile = $music->song_file_path;
        $this->isEditActive = true;
        //dd($this->passedMusic);
    }

    public function render()
    {
        return view('livewire.music.music-edit');
    }
}
