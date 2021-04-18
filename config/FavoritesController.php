<?php
require_once('../Model/User.php');


    // お気に入りチェック
    public function check($send) {
        $count = $this->Favorite->findAll($send);
        return $count;
    }

    // お気に入り登録
    public function favoriteAdd($send) {
        $this->Favorite->add($send);
    }
    // お気に入り解除
    public function favoriteDelete($send) {
        $this->Favorite->delete($send);
    }





}