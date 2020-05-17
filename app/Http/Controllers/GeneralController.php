<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Barang;
use App\Keranjang;
use App\Transaction;
use App\Toko;
use App\Rating;
use DB;
use Auth;

class GeneralController extends Controller
{
    public function home()
    {
        if (Auth::guard('user')->check()) {
            $data['jml'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)
                ->where('keranjangs.status', '=', null)
                ->count();
        }
        $data['kategori'] = Kategori::all();
        return view('home', $data);
    }

    public function detailproduk($id){
        if (Auth::guard('user')->check()) {
            $data['jml'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)
                ->where('keranjangs.status', '=', null)
                ->count();
        }
        $data['produk'] = DB::table('barangs')
        ->join('tokos', 'barangs.id_toko', '=', 'tokos.id')
        ->select('barangs.*', 'tokos.nama_toko', 'tokos.alamat', 'tokos.phone')
        ->where('barangs.id','=',$id)->get();
        return view('detailproduk', $data);
    }

    public function uploadbukti(){
        $file_tmp = $_FILES['bukti']['tmp_name'];
        $data = file_get_contents($file_tmp);
        $base64 = base64_encode($data);
        Transaction::where('id','=', $_POST['idtrans'])->update([
            'status' => "Menunggu konfirmasi pembayaran oleh admin",
            'bukti' => $base64,
        ]);
        return redirect('/transaksi')->with('sukses', "Upload Bukti Perbayaran Berhasil!!");
    }

    public function detailtoko($id){
        if (Auth::guard('user')->check()) {
            $data['jml'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)
                ->where('keranjangs.status', '=', null)
                ->count();
        }
        $data['rating'] = Rating::where('id_toko', '=', $id)->avg('rating');
        $data['toko'] = DB::table('tokos')
        ->join('users', 'tokos.id_owner', '=', 'users.id')
        ->select('tokos.*', 'users.nama')
        ->where('tokos.id','=',$id)->get();
        return view('detailtoko', $data);
    }

    public function ratingshop(){
        if (Auth::guard('user')->check()) {
            $data['jml'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)
                ->where('keranjangs.status', '=', null)
                ->count();
        }
        $data = DB::table('ratings')->
        join('users', 'ratings.id_user', '=', 'users.id')->
        select('ratings.*', 'users.nama')->
        where('id_toko', '=', $_POST['idtoko'])->get();
        echo json_encode($data);
    }

    public function listtrans()
    {
        $data['jml'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)
            ->where('keranjangs.status', '=', null)
            ->count();
        return view('transaksi', $data);
    }

    public function gettrans()
    {
        $data = Transaction::where('id_user', '=', Auth::guard('user')->user()->id)->get();
        echo json_encode($data);
    }

    public function cekbelanjaan()
    {
        $data = Keranjang::select('id_toko')->where('id_user', '=', Auth::guard('user')->user()->id)->groupBy('id_toko')->get();
        $datax = $data->count();
        echo json_encode($datax);
    }

    public function cekout($id)
    {
        $id_ker = "";
        $total = 0;
        $data = DB::table('keranjangs')->where('id_user', '=', Auth::guard('user')->user()->id)->where('status', '=', null)->get();
        for ($i = 0; $i < sizeof($data); $i++) {
            if ($i == (sizeof($data) - 1)) {
                $id_ker .= $data[$i]->id;
            } else {
                $id_ker .= $data[$i]->id . ",";
            }
            $total += $data[$i]->total;
            Keranjang::where('id', '=', $data[$i]->id)->update([
                'status' => "checkout"
            ]);
        }
        Transaction::create([
            'id_user' => $id,
            'id_ker' => $id_ker,
            'status' => "Menunggu konfirmasi admin",
            'total' => $total
        ]);
        return redirect('/keranjang')->with('sukses', "Belanjaan anda berhasil di checkout");
    }

    public function keranjang()
    {
        $data['kategori'] = Kategori::all();
        $data['jml'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)
            ->where('keranjangs.status', '=', null)
            ->count();
        return view('keranjang', $data);
    }

    public function giverating(){
        Rating::create([
            'id_toko' => $_POST['idtoko'],
            'id_user' => $_POST['id_user'],
            'rating' => $_POST['rate'],
            'komentar' => $_POST['komen']
        ]);
        return redirect('/detailtoko/'.$_POST['idtoko'])->with('sukses', "Berhasil memberikan ulasan");
    }

    public function getbarang()
    {
        if (Auth::guard('user')->check()) {
            $id_toko = Toko::where('id_owner', Auth::guard('user')->user()->id)->count();
            if ($id_toko==1) {
                $toko = Toko::select('id')->where('id_owner', Auth::guard('user')->user()->id)->get();
                $data = Barang::where('id_toko', '<>', $toko[0]->id)->get();
            }else{
                $data = Barang::all();    
            }
            // $data = Barang::where('id_toko', '<>', $id_toko[0]->id)->get();
        } else {
            $data = Barang::all();
        }
        echo json_encode($data);
    }

    public function searchbarang()
    {
        if (Auth::guard('user')->check()) {
            $id_toko = Toko::where('id_owner', Auth::guard('user')->user()->id)->count();
            if ($id_toko==1) {
                $toko = Toko::select('id')->where('id_owner', Auth::guard('user')->user()->id)->get();
                $data = Barang::where('nama_barang', 'like', '%' . $_POST['keyword'] . '%')->where('id_toko', '<>', $toko[0]->id)->get();
            }else{
                $data = Barang::where('nama_barang', 'like', '%' . $_POST['keyword'] . '%')->get();    
            }
        } else {
            $data = Barang::where('nama_barang', 'like', '%' . $_POST['keyword'] . '%')->get();
        }

        echo json_encode($data);
    }

    public function getbykategori()
    {
        if (Auth::guard('user')->check()) {
            $id_toko = Toko::where('id_owner', Auth::guard('user')->user()->id)->count();
            if ($id_toko==1) {
                $toko = Toko::select('id')->where('id_owner', Auth::guard('user')->user()->id)->get();
                $data = Barang::where('id_kategori', '=', $_GET['id'])->where('id_toko', '<>', $toko[0]->id)->get();
            }else{
                $data = Barang::where('id_kategori', '=', $_GET['id'])->get();
            }
        } else {
            $data = Barang::where('id_kategori', '=', $_GET['id'])->get();
        }
        echo json_encode($data);
    }

    public function getbasket()
    {
        $data['item'] = DB::table('keranjangs')
            ->join('barangs', 'keranjangs.id_barang', '=', 'barangs.id')
            ->join('tokos', 'keranjangs.id_toko', '=', 'tokos.id')
            ->select('keranjangs.*', 'barangs.nama_barang', 'barangs.foto', 'tokos.nama_toko')
            ->where('keranjangs.id_user', '=', Auth::guard('user')->user()->id)
            ->where('keranjangs.status', '=', null)
            ->get();
        $data['total'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)->where('keranjangs.status', '=', null)->sum('total');
        echo json_encode($data);
    }

    public function addItem()
    {
        $barang = Barang::where('id', '=', $_POST['idb'])->first();
        $item = Keranjang::where('id', '=', $_POST['id'])->first();
        Keranjang::where('id', '=', $_POST['id'])->update([
            'qty' => $item->qty + 1,
            'total' => $item->total + $barang->harga
        ]);
        $data['item'] = Keranjang::where('id', '=', $_POST['id'])->get();
        $data['total'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)->where('keranjangs.status', '=', null)->sum('total');
        echo json_encode($data);
    }

    function mytoko()
    {
        $data['jml'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)
            ->where('keranjangs.status', '=', null)
            ->count();            
        $data['toko'] = DB::table('tokos')->join('ratings', 'tokos.id', '=', 'ratings.id_toko')
        ->select('tokos.*', 'ratings.rating')
        ->where('id_owner', '=', Auth::guard('user')->user()->id)->get();
        $data['ulas'] = Rating::where('id_toko', $data['toko'][0]->id)->count();
        $data['kategori'] = Kategori::all();
        return view('shop', $data);
    }

    function getbyshop()
    {
        $jml = Barang::where('id_toko', '=', $_POST['idtoko'])->get();
        echo json_encode($jml);
    }

    function addToko()
    {
        $file_tmp = $_FILES['foto']['tmp_name'];
        $data = file_get_contents($file_tmp);
        $base64 = base64_encode($data);
        Toko::create([
            'id_owner' => Auth::guard('user')->user()->id,
            'nama_toko' => $_POST['namatoko'],
            'alamat' => $_POST['alamat'],
            'foto' => $base64,
            'phone' => $_POST['phone']
        ]);
        return redirect('/mytoko')->with('sukses', "Toko berhasil dibuat!!");
    }

    function addGood()
    {
        if ($_POST['kategori'] == "") {
            return redirect('/mytoko')->with('gagal', "Tambah barang gagal!! Silahkan pilih kategori terlebih dahulu!");
        } else {
            $file_tmp = $_FILES['foto']['tmp_name'];
            $data = file_get_contents($file_tmp);
            $base64 = base64_encode($data);
            Barang::create([
                'id_kategori' => $_POST['kategori'],
                'id_toko' => $_POST['idtoko'],
                'nama_barang' => $_POST['namabarang'],
                'deskripsi' => $_POST['desc'],
                'harga' => $_POST['harga'],
                'stok' => $_POST['stok'],
                'foto' => $base64
            ]);
            return redirect('/mytoko')->with('sukses', "Barang berhasil ditambahkan!!");
        }
    }

    public function detailtrans()
    {
        $data = array();
        $id_ker = explode(',', $_POST['id_ker']);
        for ($i = 0; $i < sizeof($id_ker); $i++) {
            $x = Keranjang::join('barangs', 'keranjangs.id_barang', '=', 'barangs.id')->where('keranjangs.id', '=', $id_ker[$i])->get();
            array_push($data, $x[0]);
        }
        echo json_encode($data);
    }

    public function minusItem()
    {
        $barang = Barang::where('id', '=', $_POST['idb'])->first();
        $item = Keranjang::where('id', '=', $_POST['id'])->first();
        if ($item->qty > 1) {
            Keranjang::where('id', '=', $_POST['id'])->update([
                'qty' => $item->qty - 1,
                'total' => $item->total - $barang->harga
            ]);
        }
        $data['item'] = Keranjang::where('id', '=', $_POST['id'])->get();
        $data['total'] = Keranjang::where('id_user', '=', Auth::guard('user')->user()->id)->where('keranjangs.status', '=', null)->sum('total');
        echo json_encode($data);
    }

    public function addlist()
    {
        $cek = Keranjang::where('id_barang', '=', $_POST['id'])
            ->where('id_user', '=', Auth::guard('user')->user()->id)->count();
        $barang = Barang::where('id', '=', $_POST['id'])->first();
        $basket = Keranjang::where('id_barang', '=', $_POST['id'])
            ->where('id_user', '=', Auth::guard('user')->user()->id)->get();
        if ($cek >= 1) {
            Keranjang::where('id_barang', '=', $_POST['id'])
                ->where('id_user', '=', Auth::guard('user')->user()->id)->update([
                    'qty' => $basket->qty + 1,
                    'total' => $basket->total + $barang->harga
                ]);
        } else {
            Keranjang::create([
                'id_user' => Auth::guard('user')->user()->id,
                'id_toko' => $barang->id_toko,
                'id_barang' => $_POST['id'],
                'qty' => 1,
                'total' => $barang->harga
            ]);
        }
        return redirect('/')->with('sukses', "Barang berhasil ditambahkan ke keranjang!!");
    }

    public function delete($id)
    {
        Keranjang::where('id', '=', $id)->delete();
        return redirect('/keranjang')->with('sukses', "Hapus data berhasil!!");
    }
}
