<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class UserNotesController extends Controller
{
    public function index($id = "")
    {
        if (empty($id)) {

            $notes = Note::latest()->paginate(6);
        } else {
            $notes = Note::where('user_id', $id)->paginate(6);
        }
        return view('admin.note', compact('notes'));
    }

    public function delete_notes(Request $request)
    {
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
