<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\ProfileHistory;

use Carbon\Carbon;



class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
        
    }
    
    public function create(Request $request)
    {
    
    
        $this->validate($request,Profile::$rules);

        $profiles = new Profile;
        $form = $request->all();


        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $profiles->fill($form);
        $profiles->save();

        return redirect('admin/profile/create');
        
    }
    
    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $profiles = Profile::find($request->id);
        if (empty($profiles)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profiles]);
    }
    
    
    
   public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profile::$rules);
        // News Modelからデータを取得する
        $profiles = Profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        unset($profile_form['_token']);

        // 該当するデータを上書きして保存する
        $profiles->fill($profile_form)->save();
        
        $profilehistory = new History();
        $profilehistory->profile_id = $profiles->id;
        $profilehistory->profileedited_at = Carbon::now();
        $profilehistory->save();

        return redirect('admin/profile');

    }
}
