<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tb_produksi;
use App\Models\tb_kabupaten;

class ProduksiController extends Controller
{
    public function index()
    {
        $produksi = tb_produksi::select('tb_produksi.*', 'tb_kabupaten.nama_kabupaten')->leftJoin('tb_kabupaten', 'tb_produksi.id_kabupaten', '=', 'tb_kabupaten.id')->get();
        $availableYears = tb_produksi::select('tahun')->distinct()->pluck('tahun');

        return view('produksi', ['tb_produksi' => $produksi, 'availableYears' => $availableYears]);
    }

    public function produksi_tambah()
    {
        $tb_kabupaten = tb_kabupaten::all();
        return view('produksi_tambah', compact('tb_kabupaten'));
    }

    public function produksi_store(Request $request)
{
    DB::table('tb_produksi')->insert([
        'id_kabupaten' => $request->id_kabupaten,
        'tahun' => $request->tahun,
        'luas_panen' => $request->luas_panen,
        'produktivitas' => $request->produktivitas,
        'produksi' => $request->produksi,
    ]);

    // Memperbarui data klasterisasi setelah menambahkan data produksi baru
    // $kMeansController = new KMeansController();
    // $kMeansController->kMeansClustering($request);

    return redirect('/produksi');
}

    public function produksi_edit($id)
    {
        $produksi = DB::table('tb_produksi')->where('id', '=', $id)->get();
        return view('produksi_edit', ['tb_produksi' => $produksi]);
    }

    public function produksi_update(Request $request)
    {
        DB::table('tb_produksi')
            ->where('id', $request->id)
            ->update([
                // 'id_kabupaten'=> $request->id_kabupaten,
                'tahun' => $request->tahun,
                'luas_panen' => $request->luas_panen,
                'produktivitas' => $request->produktivitas,
                'produksi' => $request->produksi,
            ]);
        return redirect('/produksi');
    }

    public function produksi_hapus($id)
    {
        DB::table('tb_produksi')->where('id', $id)->delete();
        return redirect('/produksi');
    }
    
    public function filterProses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/produksi')->withErrors($validator)->withInput();
        }

        $tahun = $request->input('tahun');
        $produksi = null; // inisialisasi variabel

        if ($tahun == 0) {
            $produksi = DB::table('tb_produksi')->leftJoin('tb_kabupaten', 'tb_produksi.id_kabupaten', '=', 'tb_kabupaten.id')->get();
        } else {
            $produksi = DB::table('tb_produksi')->leftJoin('tb_kabupaten', 'tb_produksi.id_kabupaten', '=', 'tb_kabupaten.id')->where('tb_produksi.tahun', $tahun)->get();
        }

        $availableYears = tb_produksi::select('tahun')->distinct()->pluck('tahun');

        return view('produksi', ['tb_produksi' => $produksi, 'availableYears' => $availableYears]);
    }
}
