<?php

namespace App\Livewire\Music;

use Livewire\Component;


use App\Models\Music;

use Livewire\WithFileUploads;

use Kiwilan\Audio\Audio;



class MusicCreate extends Component
{

    use WithFileUploads;



    public string $songtitle = '';
    public string $songartist = '';
    public $songcoverimage;
    public $songaudiofile;

    public $songs;

    public function mount()
    {
        $this->songs = Music::all();
    }
    public function storeANewSong()
    {
        $this->validate(
            [
                'songtitle' => 'required|string|min:3|max:200',
                'songartist' => 'required|string|min:3|max:200',
                'songcoverimage' => 'required|image|max:4096',
                'songaudiofile' => 'required|mimes:wav,mp3|max:16384',
            ],
            [
                // Custom validation messages
                'songtitle.required' => 'The Song Title is required.',
                'songartist.required' => 'The Song Artist is required.',
                'songcoverimage.required' => 'The Cover Photo is required.',
                'songaudiofile.required' => 'The Audio is not yet properly uploaded. Please try again.',
                'songcoverimage.mimes' => 'The Cover Photo must be a file of type: jpeg, jpg, png, webp.',
                'songaudiofile.mimes' => 'The Uploaded Audio must be a .wav or .mp3 file.',
            ],
        );

        //Get The File Name and Extension then Sanitize
        $coverphoto_filename = $this->songcoverimage->getClientOriginalName();
        $music_filename = $this->songaudiofile->getClientOriginalName();

        //Get The Base Name
        $coverphoto_basename = pathinfo($coverphoto_filename, PATHINFO_FILENAME);
        $music_basename = pathinfo($music_filename, PATHINFO_FILENAME);

        //Get The Extension
        $coverphoto_ext = pathinfo($coverphoto_filename, PATHINFO_EXTENSION);
        $music_ext = pathinfo($music_filename, PATHINFO_EXTENSION);

        //Sanitize the Base Name using Filter Var of FILTER_SANITIZE_STRING then assign back value to orig var
        $coverphoto_filename = filter_var($coverphoto_basename, FILTER_SANITIZE_STRING);
        $music_filename = filter_var($music_basename, FILTER_SANITIZE_STRING);

        //Add Unique Identifiers to the Base Name
        $coverphoto_filename = $coverphoto_filename . '-' . uniqid();
        $music_filename = $music_filename . '-' . uniqid();

        //Merge Back the Extension for the Final File Name
        $coverphoto_filename = $coverphoto_filename . '.' . $coverphoto_ext;
        $music_filename = $music_filename . '.' . $music_ext;

        ////////////////////////// STORING THE MUSIC TO DATABASE

        $music_saved_file_path = $this->songaudiofile->storeAs('musics', $music_filename, 'public');

        //Get the metadata of the song

        //Get the audio path
        $fullUrl = 'storage/' . $music_saved_file_path;
        $audio = Audio::get($fullUrl);

        $audio_filesize = $audio->getAudio()->getFilesize();
        //convert the filesize into mb
        $audio_filesize_in_MB = round($audio_filesize / 1024 / 1024, 2);
        $audio_filesize_in_MB = $audio_filesize_in_MB . ' MB';

        $audio_duration = $audio->getDuration();
        // convert the duration into minutes and seconds
        $audio_duration = gmdate('i:s', $audio_duration);

        //Store the song in the database
        Music::create([
            'song_title' => $this->songtitle,
            'song_artist' => $this->songartist,
            'song_cover_photo' => $this->songcoverimage->storeAs('musics_cover_photos', $coverphoto_filename, 'public'),
            'song_file_path' => $music_saved_file_path,
            'song_duration' => $audio_duration,
            'song_filesize' => $audio_filesize_in_MB,
        ]);

        ////////////////////////// Get the File Size and File Duration //////////////////////////

        $this->reset(['songtitle', 'songartist', 'songcoverimage', 'songaudiofile']);
        session()->flash('message', 'Music Added Successfully!');
        $this->dispatch('reload-page');
    }


    public function render()
    {
        return view('livewire.music.music-create');
    }
}
