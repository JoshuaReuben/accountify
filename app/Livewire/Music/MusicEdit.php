<?php

namespace App\Livewire\Music;

use App\Models\Music;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class MusicEdit extends Component
{

    use WithFileUploads;

    public $passedMusic;

    public string $songtitle;
    public string $songartist;
    public $songcoverimage;
    public $songaudiofile;

    public function mount($passedMusic)
    {
        $this->passedMusic = $passedMusic;
        $this->songtitle = $passedMusic->song_title;
        $this->songartist = $passedMusic->song_artist;
        $this->songaudiofile = $passedMusic->song_audio_file;
        // dd($this->songcoverimage);
    }
    public function updateSong()
    {
        $this->validate(
            [
                'songtitle' => 'required|string|min:3|max:200',
                'songartist' => 'required|string|min:3|max:200',
                'songcoverimage' => 'sometimes|nullable|image|max:4096',

            ],
            [
                // Custom validation messages
                'songtitle.required' => 'The Song Title is required.',
                'songartist.required' => 'The Song Artist is required.',
                'songcoverimage.mimes' => 'The Cover Photo must be a file of type: jpeg, jpg, png, webp.',
            ],
        );

        //check if songcoverphoto is empty
        if (empty($this->songcoverimage)) {
            $this->passedMusic->update([
                'song_title' => $this->songtitle,
                'song_artist' => $this->songartist,
            ]);
        } else {
            //Get The File Name and Extension then Sanitize
            $coverphoto_filename = $this->songcoverimage->getClientOriginalName();

            //Get The Base Name
            $coverphoto_basename = pathinfo($coverphoto_filename, PATHINFO_FILENAME);

            //Get The Extension
            $coverphoto_ext = pathinfo($coverphoto_filename, PATHINFO_EXTENSION);

            //Sanitize the Base Name using Filter Var of FILTER_SANITIZE_STRING then assign back value to orig var
            $coverphoto_filename = filter_var($coverphoto_basename, FILTER_SANITIZE_STRING);
            // dump('coverphoto file name after sanitize' . $coverphoto_filename);
            //Add Unique Identifiers to the Base Name
            $coverphoto_filename = $coverphoto_filename . '-' . uniqid();

            //Merge Back the Extension for the Final File Name
            $coverphoto_filename = $coverphoto_filename . '.' . $coverphoto_ext;
            // dump('coverphoto file with extension' . $coverphoto_filename);



            //delete the original cover photo from passedmusic
            $fileExists = Storage::exists('public/' . $this->passedMusic->song_cover_photo);
            // dump($fileExists);
            if ($fileExists) {
                Storage::delete('public/' . $this->passedMusic->song_cover_photo);
            } else {
                //reload the browser
                return redirect()->back();
                exit();
            }

            //Store the song in the database
            $this->passedMusic->update([
                'song_title' => $this->songtitle,
                'song_artist' => $this->songartist,
                'song_cover_photo' => $this->songcoverimage->storeAs('musics_cover_photos', $coverphoto_filename, 'public'),
            ]);
        }

        return redirect()->route('pages.admin.music')->with('message', 'Music Updated Successfully!');
    }


    public function render()
    {
        return view('livewire.music.music-edit');
    }
}
