<?php



namespace App\Repositories;

use App\Models\Category;
use Exception;

class CategoryRepository
{
   



    public function all()
    {


    	try {
    			$categories = Category::all();
  		
    		if (count($categories) == 0) {
    				throw new Exception('Could not found any categories');
    	}

    		return response()->json($categories);
        

    	} catch (Exception $e) {
        return response()->json(['message'=>$e->getMessage()]);

    	}
    

    

    }

    

public function getById($id)
    {
    
    	try {
    			
    			$category = Category::find($id);
    			if ($category == null) {
    				throw new Exception('Could not found');
    			}

        		return response()->json($category);

    	} catch (Exception $e) {
        return response()->json(['message'=>$e->getMessage()]);

    	}
    
    }



public function store($input)
    {
    
    	try {
    			$category = Category::create($input);
	    		
	    		if ($category == null) {
	    			
	    		throw new Exception('Could not added new category');
	    		}
				
				return response()->json($category);

    		} catch (Exception $e) {
        		return response()->json(['message'=>$e->getMessage()]);

    		}        



}

    

public function update($id, $input)
{
    
        

        try {
    		
    		$category = Category::find($id);
    	
    		if ($category == null) {
    			throw new Exception('Could not found');
    	
    		}
    	
    	$category->update($input);
       
       	 return response()->json($category);


    	} catch (Exception $e) {

        return response()->json(['message'=>$e->getMessage()]);

    	}




 }




public function delete($id)
   {
    
    
          try {
    		
    		$category = Category::find($id);
    	
    		if ($category == null) {
    			throw new Exception('Could not found');
    	
    		}
    	
    	if ($category->delete()) {
				return response()->json($category);
    		}else{

    			throw new Exception('Could not deleted due to error');
    		}	
    	
       


    	} catch (Exception $e) {

        return response()->json(['message'=>$e->getMessage()]);

    	}


}






}


?>