<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ItemHelper;
use App;

class HomeController extends Controller {

  use ItemHelper;

  private $pusher;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
  public function index() {
    return view('layouts.main', [
      'items' => $this->getItems(),
      'labels' => $this->getLabels(),
      'banners' => $this->getBanners(),
      'sections' => $this->getSections(),
    ]);
  }

  public function lang($locale) {
    App::setLocale($locale);

    return $this->index();
  }


}
