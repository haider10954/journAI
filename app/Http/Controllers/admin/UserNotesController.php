<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class UserNotesController extends Controller
{
    public function index()
    {
        $notes = Note::get();
        return view('admin.note', compact('notes'));
    }

    public function delete_notes(Request $request)
    {
    }
}
