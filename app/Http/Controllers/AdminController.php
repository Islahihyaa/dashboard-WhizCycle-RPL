<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Complaint;
use App\Models\RedeemPoint;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Role;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Report;
use App\Models\Article;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function getDashboard()
    {
        $total_user = User::count();
        $recyle_total = DB::table('user')->sum('total_daur_ulang');
        $data_article = Article::all();
        return view('admin.dashboard', [
            'total_user' => $total_user,
            'recyle_total' => $recyle_total,
            'data_article' => $data_article,
        ]);
    }

    public function getManageUser()
    {
        return view('admin.manageuser', ['users' => $users]);
    }

    public function showUsers()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.manageuser', ['users' => $users]);
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
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
    {
    $user->update($request->all());

    // Redirect to a page after updating
    return redirect()->route('manageuser')->with('success', 'User updated successfully.');
}
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

        Session::flash('updateStatusVehicle',"Data berhasil diubah menjadi $statusVehicle->status_vehicle");
        return redirect('manage-vehicles');
    }

    public function deleteVehicle($vehicle_id)
    {
        $deleteVehicle = Vehicle::find($vehicle_id);
        $vehicleActive = Driver::where('vehicle_id', $vehicle_id)->first();

        if ($deleteVehicle) {
            if ($vehicleActive) {
                Session::flash('failDeleteVehicle', 'Data gagal dihapus karena kendaraan masih digunakan oleh driver');
                return redirect('manage-vehicles');
            } else {
                $deleteVehicle->delete();
                Session::flash('successDeleteVehicle', 'Data kendaraan berhasil dihapus');
                return redirect('manage-vehicles');
            }
        } else {
            Session::flash('failDeleteVehicle', 'Data kendaraan tidak ditemukan');
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
        $data_driver = Driver::all();
        return view('admin.update-order', compact('updateOrder', 'data_driver'));
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

        Article::create([
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

    public function getTableDriver()
    {
        $data_driver = Driver::all();
        return view('admin.laporan-driver', compact('data_driver'));
    }

    public function getManageDriver()
    {
        $data_driver = Driver::all();
        return view('admin.manage-driver', compact('data_driver'));
    }

    public function getAddDriver()
    {
        $data_vehicle = Vehicle::where('status_vehicle', 'Sudah Baik')->get();
        return view('admin.add-driver', compact('data_vehicle'));
    }

    public function submitAddDriver(Request $request)
    {
        $request->validate([
            'name_driver' => 'required',
            'phoneNo_driver' => 'required',
            'license_number' => 'required',
            'image_driver' => 'required',
            'vehicle_id' => 'required',
        ]);

        $driver_image_path = $request->file('image_driver')->store('driver-image', 'public');

        $createAddDriver = Driver::create([
            'name_driver' => $request->input('name_driver'),
            'phoneNo_driver'=> $request->input('phoneNo_driver'),
            'license_number' => $request->input('license_number'),
            'image_driver' => $driver_image_path,
            'vehicle_id' => $request->input('vehicle_id'),
        ]);

        if($createAddDriver) {
            Session::flash('status','Data Driver Berhasil Ditambahkan');
            return redirect('add-driver');
        } else {
            Session::flash('notSetDataMessage', 'Data Driver Gagal Ditambahkan');
            return redirect('add-driver');
        }
    }

    public function deleteDriver($driver_id)
    {
        $deleteDriver = Driver::find($driver_id);
        $deleteDriver->delete();

        if($deleteDriver) {
            Session::flash('successDeleteDriver','Data berhasil dihapus');
            return redirect('manage-driver');
        } else {
            Session::flash('failDeleteDriver','Data gagal dihapus');
            return redirect('manage-driver');
        }
    }

    public function getEditDriver($driver_id)
    {
        $editDriver = Driver::find($driver_id);
        return view('admin.edit-driver', compact('editDriver'));
    }

    public function submitEditDriver(Request $request, $driver_id)
    {
        $editDriver = Driver::find($driver_id);

        $editDriver->name_driver = $request->input('name_driver');
        $editDriver->phoneNo_driver = $request->input('phoneNo_driver');
        $editDriver->license_number = $request->input('license_number');

        if ($request->hasFile('image_driver')) {
            if ($editDriver->image_driver && \Storage::disk('public')->exists($editDriver->image_driver)) {
                \Storage::disk('public')->delete($editDriver->image_driver);
            }

            $driver_image_path = $request->file('image_driver')->store('driver-image', 'public');
            $editDriver->image_driver = $driver_image_path;
        }

        $editDriver->vehicle_id = $request->input('vehicle_id');
        $editDriver->save();
        if($editDriver) {
            Session::flash('successEditDriver','Data berhasil diubah');
            return redirect('manage-driver');
        } else {
            Session::flash('failDeleteDriver','Data gagal diubah');
            return redirect('manage-driver');
        }
    }

    public function getArticle()
    {
        $data_article = Article::all();
        return view('admin.manage-article', compact('data_article'));
    }

    public function show_detail_article(Request $request) {
        $article = Article::find($request->article_id);

        return view('admin.detail-article', [
            'article' => $article
        ]);
    }

    public function getAddArticle()
    {
        return view('admin.add-article');
    }

    public function submitAddArticle(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image_article' => 'required',
        ]);

        $article_image_path = $request->file('image_article')->store('article-image', 'public');

        $createAddArticle = Article::create([
            'title' => $request->input('title'),
            'content'=> $request->input('content'),
            'image_article' => $article_image_path,
        ]);

        if($createAddArticle) {
            Session::flash('status','Data Article Berhasil Ditambahkan');
            return redirect('add-article');
        } else {
            Session::flash('notSetDataMessage', 'Data Article Gagal Ditambahkan');
            return redirect('add-article');
        }
    }

    public function destroy_article(Request $request) {
        $article = Article::find($request->article_id);

        $article->delete();

        Session::flash('success-to-delete-article', 'Data Arttkel' . $article->title . ' Berhasil Dihapus');
        return redirect(url('manage-article'));
    }

    public function editArticle(Request $request)
    {
        $article = Article::find($request->article_id);

        return view('admin.update-article', compact('article'));
    }

    public function updateartikel(Request $request, $article_id)
    {
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image_article' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $article = Article::find($article_id);
    $article->title = $request->input('title');
    $article->content = $request->input('content');

    if ($request->hasFile('image_article')) {
        $image = $request->file('image_article');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $article->image_article = 'images/' . $imageName;
    }

    $article->save();

    return redirect()->route('edit-article', ['article_id' => $article_id])->with('success', 'Data updated successfully');
    }
}

