<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Laravel\PusherManager;
use Illuminate\Support\Facades\DB;
use App\Item;

class AuthController extends Controller {
  private $pusher;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PusherManager $pusher) {
        $this->middleware('auth');
        $this->pusher = $pusher;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
  public function index() {
    return view('layouts.main', [
      'items' => $this->getItems(),
    ]);
  }

    public function home() {
        return view('home');
    }

    public function panel() {
      return view('home', [
        'items' => $this->getItems(),
      ]);
    }


    public function save(Request $request) {
      if ($request->ajax()) {
        $items = $request->except('_token');

        foreach ($items as $key => $part) {

          DB::table('items')
            ->where('key', $key)
            ->update(['value' => $part]);
        }

        $statusCode = $this->pusher->trigger(
          'my-channel',
          'my-event',
          $items
        ) ? 200 : 500;

        return response('', $statusCode);
      }
    }


    private function getItems() {
      $items = Item::all();

      return $items->reduce(function($carry, $item) {
        return array_merge($carry, [
          $item->key => $item->value,
        ]);
      }, []);
    }

    public function fetch() {

      return [
        'a' => 3,
        'bankroll' => [
          'z' => time(),
        ],
      ];
    }
}
