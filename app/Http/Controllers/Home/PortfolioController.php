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
}
