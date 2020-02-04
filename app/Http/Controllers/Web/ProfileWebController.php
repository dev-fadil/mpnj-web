<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Konsumen;
use App\Models\Pelapak;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ProfileWebController extends Controller
{
    protected $client, $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = env('API_RAJAONGKIR');
    }
    public function index()
    {
        return view('web/web_profile');
    }

    public function ubah(Request $request, $role, $id)
    {
        $sessionId = Session::get('id');

        $data = [
          'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'nomor_hp' => $request->no_hp
        ];

        $fix_role = $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak' ;
        $ubah = $fix_role::where($sessionId, $id)->update($data);

        return redirect(URL::to('profile'));
    }
}
