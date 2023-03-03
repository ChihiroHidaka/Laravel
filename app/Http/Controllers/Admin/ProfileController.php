<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;


class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
        
    }
    
    public function create(Request $request)
    {
    
    
        $this->validate($request,Profiles::$rules);

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
    public function edit()
    {
        return view('admin.profile.edit');
    }
    
    public function update(Request $request)
    {
        return redirect('admin/profile/edit');
        
    }
}
