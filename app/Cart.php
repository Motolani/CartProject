<?php

namespace App;

class Cart
{
    public $items;
    public $totalQuantity;
    public $totalPrice;


    public function __construct($prevCart)
    {
        if ($prevCart != null) {
            $this->items = $prevCart->items;
            $this->totalPrice = $prevCart->totalPrice;
            $this->totalQuantity = $prevCart->totalQuantity;
        } else {
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
        }
    }


    public function addItem($id, $product)
    {
        $price = $product->price;
        if (array_key_exists($id, $this->items)) {
            $productToAdd = $this->items[$id];

            $productToAdd['quantity']++;
            $productToAdd['singlePrice'] = $price;
            $productToAdd['totalSinglePrice'] = $productToAdd['quantity'] * $price;
        } else {
            $productToAdd = ['quantity' => 1, 'totalSinglePrice' => $price, 'data' => $product, 'singlePrice' => $price];
        }

        $this->items[$id] = $productToAdd;
        $this->totalQuantity++;
        $this->totalPrice = $this->totalPrice + $price;
    }

    //updating the updated after changes like deleting item
    public function updatePriceAndQuantity()
    {
        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($this->items as $item) {

            $totalQuantity = $totalQuantity + $item['quantity'];
            $totalPrice = $totalPrice + $item['totalSinglePrice'];
        }
        $this->totalQuantity = $totalQuantity;
        $this->totalPrice = $totalPrice;
    }
}
