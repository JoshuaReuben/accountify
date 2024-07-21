<?php

namespace Database\Seeders;

use App\Models\Music;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Music::create([
            'song_title' => 'G Minor Bach',
            'song_artist' => 'Johann Sebastian Bach',
            'song_cover_photo' => 'musics_cover_photos/1.jpg',
            'song_file_path' => 'musics/GMinorBach.mp3',
            'song_duration' => '2:58',
            'song_filesize' => '4.08MB',
        ]);

        Music::create([
            'song_title' => 'Fur Elise',
            'song_artist' => 'Beethoven',
            'song_cover_photo' => 'musics_cover_photos/2.jpg',
            'song_file_path' => 'musics/Fur Elise.mp3',
            'song_duration' => '3:45',
            'song_filesize' => '5.16MB',
        ]);
    }
}
