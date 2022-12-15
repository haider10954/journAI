<?php

namespace App\Http\Controllers\user;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function notes_listing()
    {

        $notes = Note::where('user_id', auth()->id())->get();
        $response = Http::post('http://3.140.248.219:8000/predict_api', [
            'text' => 'Hello',
        ]);
        return view('user.notes', compact('notes'));
    }
    function upload_files($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/notes/', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    public function add_note(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'mimes:jpg,jpeg,png'
        ]);

        $file = $this->upload_files($request['file']);

        $note = Note::create([
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $file,
        ]);

        if ($note) {
            return json_encode([
                'success' => true,
                'message' => 'Note has been added successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong Please try again.',
            ]);
        }
    }
}
