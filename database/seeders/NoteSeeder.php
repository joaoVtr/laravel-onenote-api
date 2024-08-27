<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notes =  Note::factory()->count(10)->create();

        $notes->each(function ($note) use ($notes){
            $totalParentID = $notes->where('parent_id' , $note->parent_id)->count();
            if($totalParentID == 0){
                $note->parent_id = $note->id;
            }else{
                $note->parent_id = Note::all()->random()->id;
            }
            $note->level = $notes->where('parent_id' , $note->parent_id)->count();
            $note->order = $note->level;
            $note->save();
        });
    }
}
