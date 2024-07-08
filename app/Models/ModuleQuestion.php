<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;


class ModuleQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'question',
        'choices',
        'correct_answer'
    ];

    protected $casts = [
        'choices' => 'array', // Automatically casts the choices attribute to an array
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
