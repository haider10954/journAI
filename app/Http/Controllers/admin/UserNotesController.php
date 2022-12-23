<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class UserNotesController extends Controller
{
    public function index()
    {
        $notes = Note::paginate(1);
        return view('admin.note', compact('notes'));
    }

    public function delete_notes(Request $request)
    {
        $notes = Note::where('id', $request->id)->first();
        $filePath = storage_path('app/public/notes/' . $notes->image);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $user_notes = Note::where('id', $request->id)->delete();
        if ($user_notes) {
            return response()->json([
                'success' => true,
                'message' => 'Note deleted successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong Please try again',
            ]);
        }
    }
}
