<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    public function index()
    {
        $farmers = Farmer::getData(true)->paginate(10);
        return view('pages.farmers', compact(['farmers']));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'nic' => 'required|string',
            'address' => 'string',
            'notes' => 'string',
            'isnew' => 'required|numeric',
            'record' => 'nullable|numeric',
        ]);

        $data = [
            'name' => $request->name,
            'nic' => $request->nic,
            'address' => $request->address,
            'notes' => $request->notes,
            'status' => $request->status ?? 1,
        ];

        if ($request->has('image')) {
            $data['img'] = $this->uploadImage($request->file('image'), Carbon::now()->format('YmdHs'), $request->image);
        }

        if ($request->isnew == 1) {
            Farmer::create($data);
        } else {
            Farmer::where('id', $request->record)->update($data);
        }

        return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Successfully ' . (($request->isnew == 1) ? 'Registered' : 'Updated')]);
    }

    public function uploadImage($valid, $name, $file)
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $name = $name . '.' . $ext;
        $upload_path = 'assets/img/uploads';
        $image_url = $upload_path . $name;
        $file->move($upload_path, $name);
        return $name;
    }


    public function deleteOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:farmers,id'
        ]);

        Farmer::where('id', $request->id)->update(['status' => 3]);
        return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Successfully Removed']);
    }

    public function getOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:farmers,id'
        ]);
        $data = Farmer::where('id', $request->id)->first();
        return $data;
    }
}
