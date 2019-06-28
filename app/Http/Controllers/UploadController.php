<?php

namespace App\Http\Controllers;
use App\Gambar;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(){
		$gambar = Gambar::get();
		return view('upload',['gambar' => $gambar]);
	}
 
	public function proses_upload(Request $request){
		$this->validate($request, [
			'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'judul' => 'required',
            'isi' => 'required',
		]);
 
		$file = $request->file('file');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);
 
		Gambar::create([
			'file' => $nama_file,
            'judul' => $request->judul,
            'isi' => $request->isi,
		]);
 
		return redirect()->back();
	}
}