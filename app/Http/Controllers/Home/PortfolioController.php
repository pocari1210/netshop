<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use InterventionImage;
use Illuminate\Support\Carbon;

class PortfolioController extends Controller
{
  public function AllPortfolio()
  {
    $portfolio = Portfolio::latest()->get();

    return view(
      'admin.protfolio.protfolio_all',
      compact('portfolio')
    );
  } // End Method

  // Portfolio：新規作成のコントローラー
  public function AddPortfolio()
  {
    return view('admin.protfolio.protfolio_add');
  } // End Method

  // Portfolio：保存処理のコントローラー
  public function StorePortfolio(Request $request)
  {
    $request->validate(
      [
        'portfolio_name' => 'required',
        'portfolio_title' => 'required',
        'portfolio_image' => 'required',
      ],

      // バリデーションエラーのコメント
      [
        'portfolio_name.required' => 'Portfolio Name is Required',
        'portfolio_title.required' => 'Portfolio Title is Required',
      ]
    );

    $image = $request->file('portfolio_image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

    InterventionImage::make($image)->resize(1020, 519)->save('upload/portfolio/' . $name_gen);
    $save_url = 'upload/portfolio/' . $name_gen;

    Portfolio::insert([
      'portfolio_name' => $request->portfolio_name,
      'portfolio_title' => $request->portfolio_title,
      'portfolio_description' => $request->portfolio_description,
      'portfolio_image' => $save_url,
      'created_at' => Carbon::now(),

    ]);
    $notification = array(
      'message' => 'Portfolio Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.portfolio')->with($notification);
  } // End Method  

  // 編集のコントローラー
  public function EditPortfolio($id)
  {
    $portfolio = Portfolio::findOrFail($id);

    return view(
      'admin.protfolio.protfolio_edit',
      compact('portfolio')
    );
  } // End Method

  // 更新処理のルート
  public function UpdatePortfolio(Request $request)
  {

    $portfolio_id = $request->id;

    if ($request->file('portfolio_image')) {
      $image = $request->file('portfolio_image');
      $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

      InterventionImage::make($image)->resize(1020, 519)->save('upload/portfolio/' . $name_gen);
      $save_url = 'upload/portfolio/' . $name_gen;

      Portfolio::findOrFail($portfolio_id)->update([
        'portfolio_name' => $request->portfolio_name,
        'portfolio_title' => $request->portfolio_title,
        'portfolio_description' => $request->portfolio_description,
        'portfolio_image' => $save_url,
      ]);

      $notification = array(
        'message' => 'Portfolio Updated with Image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.portfolio')->with($notification);
    } else {

      Portfolio::findOrFail($portfolio_id)->update([
        'portfolio_name' => $request->portfolio_name,
        'portfolio_title' => $request->portfolio_title,
        'portfolio_description' => $request->portfolio_description,
      ]);

      $notification = array(
        'message' => 'Portfolio Updated without Image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.portfolio')->with($notification);
    } // end Else

  } // End Method 

  public function DeletePortfolio($id)
  {
    $portfolio = Portfolio::findOrFail($id);
    $img = $portfolio->portfolio_image;
    unlink($img);

    Portfolio::findOrFail($id)->delete();

    $notification = array(
      'message' => 'Portfolio Image Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 
}
