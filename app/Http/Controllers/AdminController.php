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
        $total_user = User::count();
        $recyle_total = DB::table('user')->sum('total_daur_ulang');
        $data_article = Article::all();
        return view('admin.dashboard', [
            'total_user' => $total_user,
            'recyle_total' => $recyle_total,
            'data_article' => $data_article,
        ]);
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
            Session::flash('status','Artikel Berhasil di Publish'); // Perubahan
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
    public function updateartikel(Request $request)
    {
        $article = Article::find($request->article_id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->image_article = $request->input('image_article');


        $item->save();
        return redirect('articleupp/')->with('success', 'Data updated successfully');
    }
}
