<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class View extends Component 
{
    public $category, $product, $prodColorSelectedQuantity, $quantityCount = 1, $productColorId;

    public function addToWishlist($productId){
        if(Auth::check()){
            if(Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()){
                session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added to wishlist',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            }else{
                $wishlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message', 'Wishlist  added successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist  added successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        }else{
            session()->flash('message', 'Please Log-in to Continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Log-in to Continue',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function colorSelected($productColorId){
        // dd($productColorId);
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if($this->prodColorSelectedQuantity == 0){
            $this->prodColorSelectedQuantity = 'OutofStock';
        }
    }

    public function incrementQuantity(){
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    }
    public function decrementQuantity(){
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }

    public function addToCart(int $productId){
        if(Auth::check()){
            if($this->product->where('id', $productId)->where('status', '0')->exists()){
                //product with color
                if($this->product->productColors()->count() > 0){
                    if($this->prodColorSelectedQuantity != NUll){
                        if(Cart::where('user_id', auth()->user()->id)
                            ->where('product_id', $productId)
                            ->where('product_color_id', $this->productColorId)
                            ->exists()){
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Already Added',
                                    'type' => 'warning',
                                    'status' => 401
                                ]);
                        }else{
                            $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                            if($productColor->quantity > 0){
                                if($productColor->quantity >= $this->quantityCount){
                                    //insert to cart
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount
                                    ]);

                                    $this->emit('cartAddedUpdated');
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Product Added to Cart',
                                        'type' => 'success',
                                        'status' => 200
                                    ]);
                                }else{
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Only '.$productColor->quantity.' Quantity Available',
                                        'type' => 'warning',
                                        'status' => 401
                                    ]);
                                }
                            }else{
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Out of Stocks',
                                    'type' => 'warning',
                                    'status' => 401
                                ]);
                            }
                        }
                    }else{
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select Your Product Color',
                            'type' => 'info',
                            'status' => 401
                        ]);
                    }
                }else{
                    if(Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()){
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Already Added',
                            'type' => 'warning',
                            'status' => 401
                        ]);
                    }else{
                        //without color
                        if($this->product->quantity > 0){
                            if($this->product->quantity >= $this->quantityCount){
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount
                                ]);

                                $this->emit('cartAddedUpdated');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Added to Cart',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            }else{
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only '.$this->product->quantity.' Quantity Available',
                                    'type' => 'warning',
                                    'status' => 401
                                ]);
                            }
                        }else{
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Out of Stocks',
                                'type' => 'warning',
                                'status' => 401
                            ]);
                        }
                    }
                }
            }else{
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product Does not exists',
                    'type' => 'warning',
                    'status' => 401
                ]);
            }
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Log-in to add to Cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function mount($category, $product){
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
