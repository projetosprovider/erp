<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $today = $yesterday = $older = [];

        $yesterdayDate = now()->modify('-1 day');

        foreach($user->notifications as $notification) {
            if($notification->created_at >= now()->format('Y-m-d '). '00:00:00') {
              $today[] = $notification;
            }
            if($notification->created_at >= $yesterdayDate->format('Y-m-d '). '00:00:00' &&
                $notification->created_at <= $yesterdayDate->format('Y-m-d '). '23:59:59') {
                  $yesterday[] = $notification;
            }
            if($notification->created_at < $yesterdayDate->format('Y-m-d '). '00:00:00') {
                  $older[] = $notification;
            }
        }

        return view('admin.notifications.index', compact('user', 'today', 'yesterday', 'older'));
    }

    public function markAsRead()
    {
        $user = Auth::user();

        $user->unreadNotifications->markAsRead();

        notify()->flash('Ok', 'info', [
          'text' => 'Não possui notificações pendades de visualização.'
        ]);

        return back();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
