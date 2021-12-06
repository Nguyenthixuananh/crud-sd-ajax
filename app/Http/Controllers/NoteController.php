<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Auth::user()->notes()->orderBy('id', 'desc')->paginate(4);
        return view('note.index', [
            'notes' => $notes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $note= new Note();
        $note->fill($request->all());
        $note->user_id = Auth::user()->id;
        $note->save();
//        $note = Note::updateOrCreate(
//            [
//                'id' => $request->id
//            ],
//            [
//                $request->all()
//            ]);
        return response()->json([
            'data' => $note,
            'message' => 'Tạo Note thành công ròiii :))))))'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $note = Note::find($id);
        return response()->json([
            'data' => $note
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $note = Note::find($id);
        return response()->json([
            'data' => $note
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
        $note = Note::find($id)->update($request->all());
        return response()->json(['data' => $note], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Note::find($id)->delete();
        return response()->json(['data' => 'removed'], 200);
    }

    public function search(Request $request)
    {
        $output = '';
        $notes = Note::where('name', 'LIKE', '%' . $request->keyword . '%')->get();
        foreach ($notes as $note) {
            $output = '<tr>
                    <td>' . $note->id . '</td>
                    <td>' . $note->name . '</td>
                    <td>' . $note->description . '</td>
                    <td>' . $note->category . '</td>
                    <td>
                        <button type="button" data-target="#show"
                                data-toggle="modal" class="btn btn-info btn-show">Detail
                        </button>
                        <button type="button" data-target="#edit"
                                data-toggle="modal" class="btn btn-warning btn-edit">Edit
                        </button>
                        <button type="button" data-target="#delete"
                                data-toggle="modal" class="btn btn-danger btn-delete">Delete
                        </button>
                    </td>
                </tr>';
        }

        return response()->json($output);
    }
}
