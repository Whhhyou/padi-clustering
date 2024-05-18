<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tb_perhitungan;
use App\Models\tb_produksi;

class KMeansController extends Controller
{
    public function index()
    {
        $clustering = tb_perhitungan::all();
        $availableYears = tb_produksi::select('tahun')->distinct()->pluck('tahun');
        return view('kmeans', compact('clustering', 'availableYears'));
    }

    public function kMeansClustering(Request $request)
    {
        // Periksa apakah data clustering sudah ada di tabel tb_perhitungan
        // if (tb_perhitungan::count() > 0) {
        //     return redirect('/tampil_clustering');
        // }

        $data = DB::table('tb_produksi')->select('id_kabupaten', 'tahun', 'luas_panen', 'produktivitas', 'produksi')->get();
        
        // Inisialisasi centroid awal secara acak
        $k = 3; // Misalnya, kita ingin 3 klaster
        $centroids = $this->initializeCentroids($data, $k);

        // Iterasi hingga konvergensi
        $maxIterations = 100;
        for ($i = 0; $i < $maxIterations; $i++) {
            // Hitung jarak dan assign klaster
            $clusters = $this->assignClusters($data, $centroids);

            // Perbarui centroid
            $newCentroids = $this->updateCentroids($data, $clusters, $k);

            // Cek konvergensi
            if ($centroids == $newCentroids) {
                break;
            }

            $centroids = $newCentroids;
        }
        
        // Simpan hasil klasterisasi jika belum ada
        foreach ($clusters as $clusterIndex => $cluster) {
            foreach ($cluster as $point) {
                // Periksa apakah data sudah ada di dalam klaster
                $existingCluster = tb_perhitungan::where('id_kabupaten', $point->id_kabupaten)
                    ->where('tahun', $point->tahun)
                    ->first();

                // Jika data belum ada di dalam klaster, simpan
                if (!$existingCluster) {
                    tb_perhitungan::create([
                        'id_kabupaten' => $point->id_kabupaten,
                        'tahun' => $point->tahun,
                        'luas_panen' => $point->luas_panen,
                        'produktivitas' => $point->produktivitas,
                        'produksi' => $point->produksi,
                        'cluster' => $clusterIndex + 1, // Memperbarui nomor klaster
                    ]);
                }
            }
        }
        return redirect('/tampil_clustering');
    }

    private function initializeCentroids($data, $k)
    {
        $centroids = [];

        // Ambil titik-titik acak sebagai centroid awal
        $randomKeys = array_rand($data->toArray(), $k);
        foreach ($randomKeys as $key) {
            $centroids[] = [
                'luas_panen' => $data[$key]->luas_panen,
                'produktivitas' => $data[$key]->produktivitas,
                'produksi' => $data[$key]->produksi,
            ];
        }

        return $centroids;
    }

    private function assignClusters($data, $centroids)
    {
        $clusters = [];

        foreach ($data as $point) {
            $minDistance = PHP_INT_MAX;
            $closestCentroid = null;

            foreach ($centroids as $index => $centroid) {
                $distance = sqrt(pow($point->luas_panen - $centroid['luas_panen'], 2) + pow($point->produktivitas - $centroid['produktivitas'], 2) + pow($point->produksi - $centroid['produksi'], 2));
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestCentroid = $index;
                }
            }

            $clusters[$closestCentroid][] = $point;
        }

        return $clusters;
    }

    private function updateCentroids($data, $clusters, $k)
    {
        $newCentroids = [];

        foreach ($clusters as $cluster) {
            $luas_panenTotal = 0;
            $produktivitasTotal = 0;
            $produksiTotal = 0;

            foreach ($cluster as $point) {
                $luas_panenTotal += $point->luas_panen;
                $produktivitasTotal += $point->produktivitas;
                $produksiTotal += $point->produksi;
            }

            $clusterSize = count($cluster);
            $newCentroids[] = [
                'luas_panen' => $clusterSize > 0 ? $luas_panenTotal / $clusterSize : 0,
                'produktivitas' => $clusterSize > 0 ? $produktivitasTotal / $clusterSize : 0,
                'produksi' => $clusterSize > 0 ? $produksiTotal / $clusterSize : 0,
            ];
        }

        // Jika jumlah klaster kurang dari k, tambahkan centroid baru secara acak
        $missing = $k - count($newCentroids);
        if ($missing > 0) {
            $additionalCentroids = $this->initializeCentroids($data, $missing);
            $newCentroids = array_merge($newCentroids, $additionalCentroids);
        }

        return $newCentroids;
    }

    public function filterClusteringByYear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/tampil_clustering')->withErrors($validator)->withInput();
        }

        $tahun = $request->input('tahun');
        $clustering = null; // inisialisasi variabel

        if ($tahun == 0) {
            $clustering = tb_perhitungan::all();
        } else {
            $clustering = tb_perhitungan::where('tahun', $tahun)->get();
        }

        $availableYears = tb_perhitungan::select('tahun')->distinct()->pluck('tahun');

        return view('kmeans', ['clustering' => $clustering, 'availableYears' => $availableYears]);
    }
}
