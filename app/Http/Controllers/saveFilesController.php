<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;


class saveFilesController extends Controller
{

    // lista los archivos
    public function index()
    {
        return view('welcome', ['listFiles' => File::all()]);
    }

    // guardar
    public function saveFile(Request $request)
    {


        $validation = $request->validate([ 
            'file' => 'required',
            'description' => 'required'
        ]);

        // trata con la carga de archivos a formulario y asigna los parametros correcpondientes
    

        if ($request->hasFile('file')) {
            $newFile = new File;

            $file = $request->file('file');

            /* $filename = $request->getSchemeAndHttpHost() . '/assets/files/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/files/'), $filename); */

            $filename = $request->getSchemeAndHttpHost() . '/assets/files/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/files/'), $filename);


            $newFile->file = $filename;
            $newFile->description = $request->description;
            $newFile->fileType = strtoupper($file->getClientOriginalExtension());
            $newFile->save();
        }

        return redirect('/');
    }

    // delete
    public function delete($id)
    {
        $file = File::find($id);
        $file->delete();
        return redirect('/');
    }






}