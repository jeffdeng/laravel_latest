<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Jobs\SendReminderEmail;
use Mail;
use Redis;
class HomeController extends Controller
{
	
	/**
	 * Send a reminder e-mail to a given user.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function sendReminderEmail(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$email='251040871@qq.com';
		$name='qin';
		$uid='123456';
		$code='88889999';
		$data = ['email'=>$email, 'name'=>$name, 'uid'=>$uid, 'activationcode'=>$code];
		Mail::send('emails.reminder', $data, function($message) use($data)
		{
			$message->to($data['email'], $data['name'])->subject('欢迎注册我们的网站，请激活您的账号！');
		});
		
		//$this->dispatch(new SendReminderEmail($user));
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
  // return 	$redis=Redis::connection();
  // LRedis::del();
    		Redis::lpush('b',[121]);
   	 	return $user = Redis::lpop('b');
   // 	return  $url = route('h', ['id' => 1]);;
      
		//return $user->findOrNew(1);
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
        //c
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
