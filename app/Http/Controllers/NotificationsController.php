<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Read;
use Illuminate\Http\Request;
use PHPUnit\Framework\Error\Notice;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        /** 既読済みの通知 */
        $read_notice = Notification::whereHas('reads', function($query) use($user){

            $query->where('user_id', $user->id)
                ->where('read', true);

        })
        ->orderBy('created_at', 'desc')
        ->get();

        /** 未読の通知 */
        $new_notice = Notification::whereHas('reads', function($query) use($user){
            $query->where('user_id', $user->id)
                  ->where('read', false);
        })
        ->orderBy('created_at','desc')
        ->get();

        $data = [
            'read_notice' => $read_notice,
            'new_notice' => $new_notice
        ];

        return $data;
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
