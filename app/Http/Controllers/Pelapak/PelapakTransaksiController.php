<?php

namespace App\Http\Controllers\Pelapak;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PelapakTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $data['transaksi'] = Transaksi::with(['transaksi_detail' => function($q) use ($konsumen_id) {
            $q->where('pelapak_id', $konsumen_id);
        }])->get();
        return view('pelapak/transaksi/data_transaksi', $data);
//        return $data['transaksi'];
    }

    public function detail(Request $request, $id)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $data['transaksi'] = Transaksi::with(['transaksi_detail' => function($q) use ($konsumen_id) {
            $q->where('pelapak_id', $konsumen_id);
        }])->first();

        return view('pelapak/transaksi/detail_transaksi', $data);
    }

    public function update_status($id, $status)
    {
        $update = Transaksi_Detail::find($id)->update(['status_order' => $status]);
        if ($update) {
            return redirect('administrator/transaksi/detail/'.$id);
        }
    }
}
