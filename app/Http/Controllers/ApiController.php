<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Toko;
use App\Rating;
use App\Barang;
use App\Kategori;
use Hash;
use Auth;
use DB;

class ApiController extends Controller
{
	function login(){
		$u = User::where('email', '=', $_POST['email'])->first();  
		if (Hash::check($_POST['pass'], $u->password)) {
			$data['user'] = User::where('email','=',$_POST['email'])->get();
			$data['status'] = true;
		}else{
			$data['message'] = "Email / password salah";
			$data['status'] = false;
		}
		echo json_encode($data);
	}

	function getBarangToko(){
		$data['barang'] = Barang::where('id_toko', '=', $_POST['idtoko'])->get();
		$data['status'] = true;
		echo json_encode($data);
	}

	function getBarangKategori(){
		$data['barang'] = Barang::where('id_kategori', '=', $_POST['id_kategori'])->get();
		$data['status'] = true;
		echo json_encode($data);
	}

	function getKategoriById(){
		$data = Kategori::where('id', '=', $_POST['id'])->get();
		echo json_encode($data);
	}

	function register(){
		$cek = User::where('email', '=', $_POST['email'])->count();
		if ($cek >= 1) {
			$data['message'] = "Pendaftaran gagal, Email telah terdaftar";
			$data['status'] = false;
		}else{
			User::create([
				'nama' => $_POST['nama'],
				'email' => $_POST['email'],
				'password' => Hash::make($_POST['pass']),
				'phone' => $_POST['phone'],
				'alamat' => $_POST['alamat'],
				]);
			$data['message'] = "Akun berhasil dibuat";
			$data['status'] = true;
		}
		echo json_encode($data);
	}

	function getUser(){
		$data = User::where('id','=',$_POST['id'])->get();
		echo json_encode($data);
	}

	function cekToko(){
		$jml = Toko::where('id_owner','=',$_POST['id'])->count();
		if ($jml == 1) {
			$data['status'] = true;
			$data['toko'] = Toko::where('id_owner','=',$_POST['id'])->get();
			echo json_encode($data);
		}else{
			$data['status'] = false;
			echo json_encode($data);
		}
	}

	function getToko(){
		$data['status'] = true;
		$data['rating'] = Rating::where('id_toko', '=', $_POST['id'])->avg('rating');
		$data['jmlbarang'] = Barang::where('id_toko', '=', $_POST['id'])->count();
		$data['komen'] = DB::table('ratings')->join('users', 'ratings.id_user', '=', 'users.id')->select('ratings.*', 'users.nama')->where('ratings.id_toko', '=', $_POST['id'])->limit(4)->get();
		$data['toko'] = Toko::where('id','=',$_POST['id'])->get();
		echo json_encode($data);
	}

	function cekRating(){
		$cek = Rating::where('id_user','=', $_POST['id'])->count();
		if ($cek >= 1) {
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}

	function giveRating(){
		Rating::create([
			'id_toko' => $_POST['idtoko'],
			'id_user' => $_POST['id'],
			'rating' => $_POST['rate'],
			'komentar' => $_POST['komen']
			]);
		$data['message'] = "Rating berhasil ditambahkan";
		$data['status'] = true;
		echo json_encode($data);
	}

	function addToko(){
		Toko::create([
			'id_owner' => $_POST['id'],
			'nama_toko' => $_POST['nama'],
			'alamat' => $_POST['alamat'],
			'foto' => $_POST['gambar'],
			'phone' => $_POST['telp'],
			]);
		$data['message'] = "Toko berhasil dibuat";
		$data['status'] = true;
		echo json_encode($data);
	}

	function getkategori(){
		$data = Kategori::all();
		echo $data;
	}

	function addBarang(){
		Barang::create([
			'id_kategori' => $_POST['kategori'],
			'id_toko' => $_POST['idtoko'],
			'nama_barang' => $_POST['nama'],
			'deskripsi' => $_POST['desc'],
			'harga' => $_POST['harga'],
			'stok' => $_POST['stok'],
			'foto' => $_POST['foto']
			]);
		$data['message'] = "Barang berhasil ditambahkan";
		$data['status'] = true;
		echo json_encode($data);
	}
}
