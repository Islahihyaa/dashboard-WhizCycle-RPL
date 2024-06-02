<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Report;
use App\Models\article;
use App\Models\Vehicle;
use App\Models\Complaint;
use App\Models\RedeemPoint;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Role; // Import the Role model

class AdminController extends Controller
{
    public function getDashboard()
    {
        return view('admin.dashboard');
    }

    public function getManageUser()
    {
        return view('admin.manageuser');
    }

    public function showUsers()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.manageuser', ['users' => $users]);
    }
    
    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user) 
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'role_id' => 'required|integer',
        'address' => 'nullable|string|max:255',
        'phoneNo' => 'nullable|string|max:15',
        'created_at' => 'required|date',
        'total_points' => 'required|integer'
    ]);

    // Update the user with the validated data
    $user->update($request->all());

    // Redirect to a page after updating
    return redirect()->route('manageuser')->with('success', 'User updated successfully.');
}
    public function getResponseComplaint()
    {
        $complaintdata = Complaint::all();
        return view('admin.response-complaint', compact('complaintdata'));
    }

    public function deleteComplaint($complaint_id)
    {
        $deleteComplaint = Complaint::find($complaint_id);

        $deleteComplaint->delete();
        
        if($deleteComplaint) {
            Session::flash('deleteComplaint','Data Deleted Succesfully');
            return redirect('response-complaint');
        } else {
            dd($deleteComplaint);
        }

    }

    public function updateStatus(Request $request, $complaint_id)
    {
        $statusComplaint = Complaint::find($complaint_id);
        $statusComplaint->status = $request->input('status');
        $statusComplaint->save();

        Session::flash('updateStatus',"Data Updated To $statusComplaint->status");
        return redirect('response-complaint');

    }

    public function getManageVehicle()
    {
        $data_vehicle = Vehicle::all();
        return view('admin.manage-vehicles', compact('data_vehicle'));
    }

    public function getAddVehicle()
    {
        return view('admin.add-vehicles');
    }

    public function submitAddVehicle(Request $request)
    {       
        $request->validate([
            'name_vehicle' => 'required|min:5|max:20',
            'category_vehicle' => 'required',
            'description_vehicle' => 'required',
            'status_vehicle' => 'required',
        ]);

        $createAddVehicle = Vehicle::create([
            'name_vehicle' => $request->input('name_vehicle'),
            'category_vehicle'=> $request->input('category_vehicle'),
            'description_vehicle' => $request->input('description_vehicle'),
            'status_vehicle' => $request->input('status_vehicle'),
        ]);


        if($createAddVehicle) {
            Session::flash('status','Data Kendaraan Berhasil Ditambahkan');
            return redirect('add-vehicles');
        } else { 
            Session::flash('notSetDataMessage', 'Data Kendaaraan Gagal Ditambahkan');
            return redirect('add-vehicles');
        }
    }

    public function updateStatusVehicle(Request $request, $vehicle_id)
    {
        $statusVehicle = Vehicle::find($vehicle_id);
        $statusVehicle->status_vehicle = $request->input('status_vehicle');
        $statusVehicle->save();

        Session::flash('updateStatusVehicle',"Data Updated To $statusVehicle->status_vehicle");
        return redirect('manage-vehicles');

    }

    public function deleteVehicle($vehicle_id)
    {
        $deleteVehicle = Vehicle::find($vehicle_id);
        $deleteVehicle->delete();   
        
        if($deleteVehicle) {
            Session::flash('successDeleteVehicle','Data berhasil dihapus');
            return redirect('manage-vehicles');
        } else {
            Session::flash('failDeleteVehicle','Data gagal dihapus');
            return redirect('manage-vehicles');
        }
    }

    public function getManageOrder()
    {
        $data_order = Order::all();
        return view('admin.manage-order', compact('data_order'));
    }

    public function detailOrder($schedule_id)
    {
        $updateOrder = Order::find($schedule_id);

        return view('admin.update-order', compact('updateOrder'));
    }

    public function submitUpdateOrder(Request $request, $schedule_id)
    {
        $updateOrder = Order::find($schedule_id);
        $updateOrder->status = $request->input('status');

        $updateOrder->save();

        if($updateOrder) {
            Session::flash('status','Data Order Berhasil Ditambahkan');
            return redirect('manage-order');
        } else {
            Session::flash('notSetDataMessage', 'Data Order Gagal Ditambahkan');
            return view('admin.update-order');
        }
    }

    public function historyAllReedemPoint()
    {
        $data['history'] = RedeemPoint::select("redeem_points.*",'user.name')
                            ->leftJoin('user','user.user_id','=','redeem_points.user_id')
                            ->get();
        return view('admin.reedem-point-history',$data);
    }

    public function getHistory()
    {
        $data_order = Order::all();
        return view('historyschedulepickup.index', ['data_order' => $data_order]);
    }
    
    public function deleteHistory(Request $request, $id)
    {
        error_log($request->id);
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('history')->with('success', 'Data history berhasil dihapus');
    }

    public function destroy($id)
    {
        // Cari mobil berdasarkan ID
        $order = Order::find($id);
    
        // Pastikan mobil ditemukan
        if (!$order) {
            return redirect()->back()->with('error', 'order tidak ditemukan.');
        }
    
        // Hapus mobil
        $order->delete();
    
        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Mobil berhasil dihapus.');
    }   

    
    // public function dataComplaint() 
    // {
    //     $complaintdata = Complaint::all();
    //     return view('admin.response-complaint', compact('laboratoriums'));
    // }
    public function createArticle()
    {
        return view('admin.article');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|max:1024',
        ]);

        $foto = $request->file('foto');
        $namaFoto = uniqid() . '.' . $foto->getClientOriginalExtension();
        $foto->storeAs('article', $namaFoto);

        article::create([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'foto' => $namaFoto,
        ]);

        return redirect()->route('admin.article.index')->with('success', 'Artikel edukasi lingkungan berhasil dibuat!');
    }

    public function getLaporan()
    {
        $dataVehicle = Vehicle::all();
        return view('admin.laporan', compact('dataVehicle'));
    }

    public function getTable($tableId)
    {
        if ($tableId === 'redeemPointHistoryTable') {
            $history = RedeemPoint::all();
            return view('admin.redeem-point-table', ['history' => $history]);
        } elseif ($tableId === 'userManagementTable') {
            $users = User::all();
            return view('admin.manageusertable', ['users' => $users]);
        }
        return view('table-not-found');
    }
    // Add other necessary methods here
    

    public function getTableVehicle()
    {
        $dataVehicle = Vehicle::all();
        return view('admin.laporan-vehicle', compact('dataVehicle'));
    }

    public function getTablePoint()
    {
        $data['history'] = RedeemPoint::select("redeem_points.*",'user.name')
        ->leftJoin('user','user.user_id','=','redeem_points.user_id')
        ->get();
        return view('admin.laporan-point', $data);
    }

    public function getTableCS()
    {
        $complaintdata = Complaint::all();
        return view('admin.laporan-cs', compact('complaintdata'));
    }

    public function getTableUser()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.laporan-manageuser', ['users' => $users]);
    }

}

