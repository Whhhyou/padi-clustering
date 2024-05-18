<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupaten = DB::table('tb_kabupaten')->get();
        return view('kabupaten', ['tb_kabupaten' => $kabupaten]);
    }

    public function kabupaten_tambah()
    {
        $kabupatens = DB::table('tb_kabupaten')->get();
        return view('kabupaten_tambah', ['kabupatens' => $kabupatens]);
    }

    public function kabupaten_store(Request $request)
    {
        DB::table('tb_kabupaten')->insert([
            'id' => $request->id,
            'nama_kabupaten' => $request->nama_kabupaten,
        ]);

        return redirect('/kabupaten');
    }

    public function kabupaten_edit($id)
    {
        $kabupaten = DB::table('tb_kabupaten')->where('id', '=', $id)->get();
        return view('kabupaten_edit', ['tb_kabupaten' => $kabupaten]);
    }

    public function kabupaten_update(Request $request)
    {
        DB::table('tb_kabupaten')
            ->where('id', $request->id)
            ->update([
                'id' => $request->id,
                'nama_kabupaten' => $request->nama_kabupaten,
            ]);
        return redirect('/kabupaten');
    }

    public function kabupaten_hapus($id)
    {
        DB::table('tb_kabupaten')->where('id', $id)->delete();
        return redirect('/kabupaten');
    }
}
