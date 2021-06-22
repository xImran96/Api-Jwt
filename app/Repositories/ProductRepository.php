<?php

namespace App\Repositories;
use App\Models\Product;

class ProductRepository{
   


    public function all(){


    	try {
    		
    		$products = Product::orderBy('id')
                            ->with('category')
                            ->get()
                            ->map(function($product){
                                return [
                                    'name'=>$product->name,
                             		'rent'=>$product->rent,
                             		'size'=>$product->size,
                             		'refundable_deposit'=>$product->refundable_deposit,
                                    'category_id'=>$product->category->id,
                                    'category_name'=>$product->category->name
                                ];
               });
  		
    		if (count($products) == 0) {
    				throw new Exception('Could not found any products');
    	}

    		return response()->json($products);
        

    	} catch (Exception $e) {

        return response()->json(['message'=>$e->getMessage()]);

    	}
    

    

    }

    

public function getById($id){
    
    	try {
    			
    		$product = Product::where('id', $id)
                        ->with('category')
                        ->get()
                        ->map(function($product){
                            return [
                                'name'=>$product->name,
                             	'rent'=>$product->rent,
                             	'size'=>$product->size,
                           		'refundable_deposit'=>$product->refundable_deposit,
                       	        'category_id'=>$product->category->id,
                   	            'category_name'=>$product->category->name
                                ];
               });
    			if ($product == null) {
    				throw new Exception('Could not found');
    			}

        		return response()->json($product);

    	} catch (Exception $e) {
        return response()->json(['message'=>$e->getMessage()]);

    	}
    
}



public function store($input) {
    
    	try {
    			$product = Product::create($input);
	    		
	    		if ($product == null) {
	    			
	    		throw new Exception('Could not added new product');
	    		}
				
				return response()->json($product);

    		} catch (Exception $e) {

        		return response()->json(['message'=>$e->getMessage()]);

    		}        



}

    

public function update($id, $input)
{
    
        

        try {
    		
    		$product = Product::find($id);
    	
    		if ($product == null) {
    			throw new Exception('Could not found');
    	
    		}
    	
    	$product->update($input);
       
       	 return response()->json($product);


    	} catch (Exception $e) {

        return response()->json(['message'=>$e->getMessage()]);

    	}




 }




public function delete($id)
   {
    
    
          try {
    		
    		$product = Product::find($id);
    	
    		if ($product == null) {
    			throw new Exception('Could not found');
    	
    		}
    	
    		if ($product->delete()) {

				return response()->json($product);
    		
    		}else{

    			throw new Exception('Could not deleted due to error');
    		}	
    	
       


    	} catch (Exception $e) {

        return response()->json(['message'=>$e->getMessage()]);

    	}

	}



    



}


?>