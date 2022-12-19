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

        $response = Http::asForm()->post('http://3.140.248.219:8000/predict_api', [
            'text' => $request['title'],
        ]);
        $getData = $response->collect()->toArray();

        $note = Note::create([
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'response' => json_encode($getData),
            'analytics' => json_encode($getData['predictions']),
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

    public function edit_note(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'mimes:jpg,jpeg,png'
        ]);



        $data = [];

        if (isset($request->title)) {
            $response = Http::asForm()->post('http://3.140.248.219:8000/predict_api', [
                'text' => $request['title'],
            ]);
            $getData = $response->collect()->toArray();
            $data['response'] = json_encode($getData);
            $data['analytics'] = json_encode($getData['predictions']);
            $data['title'] = $request->title;
        }

        if (isset($request->description)) {
            $data['description'] = $request->description;
        }

        if (isset($request->file)) {
            if ($request->hasFile('file')) {
                $file = $this->upload_files($request['file']);
                $data['image'] = $file;
            }
        }

        $note = Note::where('id', $request->id)->update($data);

        if ($note) {
            return json_encode([
                'success' => true,
                'message' => 'Note has been updated successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong Please try again.',
            ]);
        }
    }

    public function delete_note(Request $request)
    {
        $notes = Note::where('id', $request->id)->first();
        $filePath = storage_path('app/public/notes/' . $notes->image);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $note = Note::where('id', $request->id)->delete();
        if ($note) {
            return json_encode([
                'success' => true,
                'message' => 'Note has been deleted successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong Please try again.',
            ]);
        }
    }
}
