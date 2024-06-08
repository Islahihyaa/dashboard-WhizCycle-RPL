<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use App\Models\RedeemPoint;
use App\Models\Article;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //Show Dashboard
    public function getHome()
    {
        return view('customer.index');
    }
    // End Show Dashboard

    //Create Order
    public function createOrder()
    {
        return view('customer.order');
    }

    public function submitOrder(Request $request)
    {       
        $request->validate([
            'name' => 'required',
            'phoneNo' => 'required',
            'address' => 'required',
            'pickup_date' => 'required',
            'pickup_time' => 'required',
            'category_trash' => 'required',
            'amount' => 'required|numeric',
            'notes' => 'required',
            'file_payment' => 'required',
        ]);

        $user_id = Auth::id();

        $ordersubmission = Order::create([
            'user_id' => $user_id,
            'pickup_date'=> $request->input('pickup_date'),
            'pickup_time' => $request->input('pickup_time'),
            'category_trash'=> $request->input('category_trash'),
            'amount' => $request->input('amount'),
            'notes' => $request->input('notes'),
            'file_payment' => $request->input('file_payment'),
        ]);

        if($ordersubmission) {
            $user = User::find($user_id);
            $amount = $request->input('amount');
            if ($user) {
                $user->total_daur_ulang += $amount;
                if($amount < 10 ) {
                    $user->total_points += 5;
                } elseif ($amount > 10 && $amount < 20) {
                    $user->total_points += 10;
                } elseif ($amount > 20 ) {
                    $user->total_points += 15;
                }
                $user->save();
            }
            return redirect ('success-payment');
        }
    }

    public function getSuccessPayment()
    {
        return view('customer.form-success');
    }
    // End Create Order


    public function reedemPoint()
    {
        $data['history'] = RedeemPoint::select("redeem_points.*",'user.name')
                            ->leftJoin('user','user.user_id','=','redeem_points.user_id')
                            ->where('user.user_id',auth()->user()->user_id)
                            ->get();
        return view('customer.reedem-point',$data);
    }
    public function historyAllReedemPoint()
    {
        $data['history'] = RedeemPoint::select("redeem_points.*",'user.name')
                            ->leftJoin('user','user.user_id','=','redeem_points.user_id')
                            ->get();
        return view('customer.reedem-point-history',$data);
    }
    function storeReedemPoint(Request $request){
        try {
            $point = new RedeemPoint();
            $point->voucher = $request->voucher;
            $point->point = $request->point;
            $point->user_id = auth()->user()->user_id;
            $point->created_at = date('Y-m-d H:i:s');
            $point->save();
            
            
            $user = User::find(auth()->user()->user_id);
            $user->total_points = $user->total_points - $request->point;
            $user->save();

            return response()->json(["status"=>200]);
        } catch (\Throwable $th) {

            return response()->json(["status"=>500]);
        }
    }

    public function getRedeemspoints()
    {
        return view('customer.redeempoint1');
    }

    public function getCustomerService()
    {
        return view('customer.customer-service');
    }

    public function submitComplaint(Request $request)
    {       
        $request->validate([
            'name' => 'required',
            'phoneNo' => 'required',
            'email' => 'required',
            'subjek' => 'required',
            'description' => 'required',
        ]);

        $user_id = Auth::id();

        $complaintsubmission = Complaint::create([
            'user_id' => $user_id,
            'email' => $request->input('email'),
            'subjek'=> $request->input('subjek'),
            'description' => $request->input('description'),
        ]);

        if($complaintsubmission) {
            Session::flash('status','Tiket Berhasil Dikirimkan');
            return redirect('customer-service');
        }
    }

    public function getArticle()
    {
        $data_article = Article::all();
        return view('customer.show-article', compact('data_article'));
    }

    public function getDetailArticle(Request $request)
    {
        $data_article = Article::find($request->article_id);
        return view('customer.detail-article', [
            'article' => $data_article
        ]);
    }

    public function getHistory()
    {
        $data_order = Order::all();

        return view('customer.history-order', ['data_order' => $data_order]);
    }

    public function deleteHistory($id)
    {
        // Cari data riwayat berdasarkan ID
        $order = Order::find($id);
        
        // Pastikan data riwayat ditemukan
        if (!$order) {
            return redirect()->back()->with('error', 'Data riwayat tidak ditemukan.');
        }
        
        // Hapus data riwayat
        $order->delete();
        
        // Redirect kembali ke halaman riwayat dengan pesan sukses
        return redirect('riwayat')->with('success', 'Data riwayat berhasil dihapus.');
    }
    
}
