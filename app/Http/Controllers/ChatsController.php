<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\{MessageSent, Notifications};
use Auth;
use App\User;
use App\Models\People;
use App\Models\{Department};
use App\Models\Department\Occupation;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show chats
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $people = People::where('id', '>', 0);

        if($request->filled('active')) {
          $active = $request->get('active');
          $people->where('active', $active);
        }

        if($request->filled('department')) {
          $department = $request->get('department');
          $department = Department::uuid($department);
          $people->where('department_id', $department->id);
        }

        if($request->filled('occupation')) {
          $occupation = $request->get('occupation');
          $occupation = Occupation::uuid($occupation);
          $people->where('occupation_id', $occupation->id);
        }

        if($request->filled('search')) {

          $search = $request->get('search');

          $people->where('name', 'like', "%$search%")
          ->orWhere('id', 'like', "%$search%")
          ->orWhere('phone', 'like', "%$search%")
          ->orWhere('cpf', 'like', "%$search%");

          $people->whereHas('user', function($query) use ($search) {
            $query->where('email', 'like', "%$search%")
            ->where('nick', 'like', "%$search%");
          });

        }

        $people = $people->paginate();

        $departments = Department::all();
        $occupations = Occupation::where('department_id', $departments->first()->id)->get();

        return view('admin.chat.index', compact('people', 'departments', 'occupations'));
    }

    public function create($id)
    {
        $user = User::uuid($id);
        return view('admin.chat.conversation', compact('user'));
    }

    /**
    * Fetch all messages
    *
    * @return Message
    */
    public function fetchMessages($id)
    {
        $user = User::uuid($id);
        return Message::where('user_id', $user->id)->where('receiver_id', Auth::user()->id)
        ->orWhere('receiver_id', $user->id)->where('user_id', Auth::user()->id)->get();
    }

    /**
    * Persist message to database
    *
    * @param  Request $request
    * @return Response
    */
    public function sendMessage($id, Request $request)
    {
        $user = User::uuid($id);

        $message = Auth::user()->messages()->create([
          'message' => $request->input('message'),
          'receiver_id' => $user->id
        ]);

        $messageOnNotifications = Auth::user()->person->name . " te enviou uma mensagem.";

        broadcast(new MessageSent(Auth::user(), $message, $user))->toOthers();
        broadcast(new Notifications($user, $messageOnNotifications))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
