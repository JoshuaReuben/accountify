<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'course_name' => 'Introduction to Web Development',
            'course_description' => 'Learn the basics of web development',
            'course_difficulty' => '1st Year',
            'course_overview' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit amet rerum accusamus optio non iste repellat quos tempore officia! Mollitia.',
            'course_cover_photo' => 'courses_cover_photos/course1.jpg',
            'course_duration' => '72',
            'course_publish_date' => now(),
        ]);

        Course::create([
            'course_name' => 'Introduction to Python Programming',
            'course_description' => 'Learn the basics of Python programming',
            'course_difficulty' => '2nd Year',
            'course_overview' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit amet rerum accusamus optio non iste repellat quos tempore officia! Mollitia.',
            'course_cover_photo' => 'courses_cover_photos/course2.webp',
            'course_duration' => '68',
            'course_publish_date' => now(),
        ]);
    }
}
