<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Message;
use App\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::find($id);
        if (!$room) {
            throw new ModelNotFoundException("Sala não existente");
        }
        $user = Auth::user();
        $user->room_id = $room->id;
        $user->save();
        return view('rooms.show', compact('room'));
    }

    public function createMessage(Request $request, $id)
    {
        $room = Room::find($id);
        if (!$room) {
            throw new ModelNotFoundException("Sala não existente");
        }
        $message = new Message();
        $message->content = $request->get('content');
        $message->room_id = $room->id;
        $message->user_id = Auth::user()->id;
        $message->save();

        broadcast(new SendMessage($message));

        return response()->json($message, 201);
    }
}
