<?php

namespace App\Http\Controllers\user;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Note;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function user_index()
    {
        $user_notes = Note::where('user_id', auth()->id())->count();
        return view('user.index', compact('user_notes'));
    }
    public function notes_listing()
    {
        $notes = Note::where('user_id', auth()->id())->get();
        return view('user.notes', compact('notes'));
    }
    function upload_files($file)
    {
        if (!empty($file)) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/notes/', $fileName);
            $loadPath = storage_path('app/public/') . '/' . $fileName;
            return $fileName;
        } else {
            $fileName = '';
        }
    }

    public function add_note(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'mimes:jpg,jpeg,png'
        ]);
        $response = Http::asForm()->post('http://3.140.248.219:8000/predict_api', [
            'text' => $request['title'],
        ]);
        $getData = $response->collect()->toArray();
        $data = [
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'response' => json_encode($getData),
            'analytics' => json_encode($getData['predictions']),
            'description' => $request['description'],
        ];
        $file = $this->upload_files($request['file']);
        if (!empty($file)) {
            $data['image'] = $file;
        }
        $note = Note::create($data);

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

    public function filterdata()
    {
        $date = null;
        if (request()->has('select_range')) {
            $date = explode('to', str_replace(' ', '', request('select_range')));
        }

        $notes = Note::where('user_id', auth()->id())->when(!empty($date), function ($query) use ($date) {
            $query->whereBetween('created_at', [$date[0], $date[1]]);
        })->get();

        if ($notes) {
            if (count($notes) > 0) {
                return json_encode([
                    'success' => true,
                    'data' => $notes,
                ]);
            } else {
                return json_encode([
                    'success' => false,
                    'message' => 'No Record Found',
                ]);
            }
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong, Please try again.',
            ]);
        }
    }
}
