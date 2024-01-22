<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Read;
use App\Models\Setting;
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
        $read_notifications = Notification::where('user_id', $user->id)->where('read_flg', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        /** 未読の通知 */
        $new_notifications = Notification::where('user_id', $user->id)->where('read_flg', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        $data = [
            'read_notification' => $read_notifications,
            'new_notification' => $new_notifications
        ];

        /**未読の通知を既読に変更 */
        foreach ($new_notifications as $notification) {
            $update = Notification::find($notification->id);
            $update->read_flg = 1;

            $update->save();
        }
        if($user->company_flg == 0){
            return view('company_notification', compact(['read_notifications', 'new_notifications']));
        }else{
            return view('general_notification', compact(['read_notifications', 'new_notifications']));
        }

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
    public function edit()
    {
        $user = auth()->user();
        $setting = Setting::where('user_id', $user->id)->first();

        if($user->company_flg == 0){
            return view('company_notification_setting', compact('user', 'setting'));
        }
        else{
            return view('general_notification_setting', compact('user', 'setting'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $setting = Setting::where('user_id', $user->id)->first();

        if ($user->company_flg == 0) {
            if ($request['notice_all'] == 1) {
                $setting->notice_all_flg = 1;
                $setting->notice_reply_flg = 1;
                $setting->notice_poster_reply_flg = 1;
                $setting->notice_comment_flg = 1;
                $setting->notice_like_flg = 1;
                $setting->notice_follow_flg = 1;
                $setting->notice_bookmark_flg = 1;
                $setting->notice_posted_flg = 1;
            } else {
                $setting->notice_all_flg = 0;
                $setting->notice_comment_flg = $request['comment'];
                $setting->notice_like_flg = $request['like'];
                $setting->notice_follow_flg = $request['follow'];
                $setting->notice_bookmark_flg = $request['bookmark'];
            }

            $setting->save();

            return redirect('/company/notification');
    
        } else {
            if ($request['notice_all'] == 1) {
                $setting->notice_all_flg = 1;
                $setting->notice_reply_flg = 1;
                $setting->notice_poster_reply_flg = 1;
                $setting->notice_comment_flg = 1;
                $setting->notice_like_flg = 1;
                $setting->notice_follow_flg = 1;
                $setting->notice_bookmark_flg = 1;
                $setting->notice_posted_flg = 1;
            } else {
                $setting->notice_all_flg = 0;
                $setting->notice_reply_flg = $request['comment'];
                $setting->notice_poster_reply_flg = $request['comment'];
                $setting->notice_posted_flg = $request['posted'];
            }

            $setting->save();

            return redirect('general/notification');
    
        }

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
