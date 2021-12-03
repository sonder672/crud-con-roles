<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    function __construct() {
        $this->middleware('permission:showNote|createNote|editNote|deleteNote', 
        ['only' => ['index']]);
        $this->middleware('permission:createNote', ['only' => ['create', 'store']]);
        $this->middleware('permission:editNote', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deleteNote', ['only' => ['destroy']]);
        }

        public function index()
        {
            $notes = Notes::all();
            return view('notes/index', compact('notes'));
        }
    
        public function create()
        {
            return view('notes/create');
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'title' => 'required',
                'content' => 'required'
            ]);

            Notes::create($request->except('_token'));
            return redirect()->route('notes.index');
        }
    
        public function edit($id)
        {
            $notes = Notes::find($id);
            return view('notes/edit', compact('notes'));
        }
    
        public function update(Request $request, $id)
        {
            $request->validate([
                'title' => 'required',
                'content' => 'required'
            ]);
            $notes = Notes::findOrFail($id);
            $notes->update($request->except('_token'));
            return redirect()->route('notes.index');
        }
    
        public function destroy($id)
        {
            $note = Notes::find($id);
            $note->delete();
            return redirect()->route('notes.index'); 
        }
}
