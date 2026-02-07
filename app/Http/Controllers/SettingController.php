<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Rules\CheckingLengthDescription;

class SettingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('Setting Access'), 403);
        $this->data['action'] = route('setting.store');

        $this->data['title'] = Setting::getValue('title');
        $keyword = Setting::getValue('keyword');
        if(is_Array($keyword)){
            $keyword = implode(',',$keyword);
        }
        $this->data['keyword'] = $keyword;
        $this->data['description'] = Setting::getValue('description');
        $this->data['author'] = Setting::getValue('author');
        $this->data['favicon'] = Setting::getValue('favicon');

        return view('setting.form',$this->data);
    }

    public function store(StoreSettingRequest $request)
    {
        abort_if(Gate::denies('Setting Access'), 403);
        $request->validate(['description' => new CheckingLengthDescription($request['description'])]);
        $request['keyword'] = explode(',',$request['keyword']);
        Setting::setValue($request->except('_token'));
        return redirect()->route('setting.index')->with('success','Berhasil Menambahkan Pengaturan Baru');
    }

}
