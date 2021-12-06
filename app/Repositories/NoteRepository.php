<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;

class NoteRepository extends BaseRepository
{
public function __construct(Note $notes)
{
    parent::__construct($notes);
}
}
