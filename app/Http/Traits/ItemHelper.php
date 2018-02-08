<?php

namespace App\Http\Traits;

use App\Item;
use App\Section;

trait ItemHelper {
  private function getItems() {
    $items = Item::all();

    return $items->reduce(function($carry, $item) {
      return array_merge($carry, [
        $item->key => $item->value,
      ]);
    }, []);
  }


  private function getLabels() {
    return [
      'invested' => __('twitch.invested'),
      'earned' => __('twitch.earned'),
      'total' => __('twitch.total'),
      'delay' => __('twitch.delay'),
      'live' => __('twitch.live'),
      'localTime' => __('twitch.localTime'),
      'info' => __('twitch.info'),
      'balance' => __('twitch.balance'),
      'breakMessage' => __('twitch.breakMessage'),
      'banners' => __('twitch.banners'),
      'chat' => __('twitch.chat'),
    ];
  }

  private function getBanners() {
    return [
      'http://pokeracademy.bg/twitch/v2/poker-academy-logo-white.png',
    ];
  }

  private function getSections() {
    return Section::visible()
      ->order()
      ->get()
      ->toArray();
  }
}
