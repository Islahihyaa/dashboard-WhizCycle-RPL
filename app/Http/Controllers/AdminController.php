<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Vehicle;
use App\Models\Article;
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

    }
