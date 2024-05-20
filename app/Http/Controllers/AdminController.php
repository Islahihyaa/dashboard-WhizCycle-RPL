<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Complaint;
use App\Models\Order;
use App\Models\Driver;
use App\Models\User;


use Session;

class AdminController extends Controller
{
    public function getDashboard()
    {
        return view('admin.dashboard');
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
}
