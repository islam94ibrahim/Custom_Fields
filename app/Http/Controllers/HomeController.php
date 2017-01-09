<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Input;
class HomeController extends Controller
{

      public function AddCulomn (Request $request){
        $SameName=DB::table('entities')->where('Name',$request->Name)->first();
        if($SameName){
          return redirect('/')->with('Error', 'Column Name already exists !');
        }
        else{
        DB::table('entities')->insert([
        'Name' => $request->Name,
        'type' => $request->Type,       
        ]);
        return redirect('/')->with('Message', 'Column Added Successfully');
        }
      }

    public function store (){

        Schema::dropIfExists('values');
        $Counter=0;
  			$Columns = DB::table('entities')->select('Name', 'Type')->get();
  			foreach ($Columns as $Column) {
  				$Type=$Column->Type;
  				$Name=$Column->Name;
          if($Counter==0){
            if($Type == "integer"){
              Schema::create('values', function(Blueprint $table) use($Name) {
              $table->integer($Name)->nullable();
              });
            }
            else if($Type == "string"){
              Schema::create('values', function(Blueprint $table) use($Name) {
              $table->string($Name)->nullable();
              });
            }
            else if($Type == "text"){
              Schema::create('values', function(Blueprint $table) use($Name) {
              $table->text($Name)->nullable();
              });
            }
            else{
              Schema::create('values', function(Blueprint $table) use($Name) {
              $table->double($Name)->nullable();
              });
            }
        }
          else{
            if($Type == "integer"){
              Schema::table('values', function(Blueprint $table) use($Name) {
              $table->integer($Name)->nullable();
              });
            }
            else if($Type == "string"){
              Schema::table('values', function(Blueprint $table) use($Name) {
              $table->string($Name)->nullable();
              });
            }
            else if($Type == "text"){
              Schema::table('values', function(Blueprint $table) use($Name) {
              $table->text($Name)->nullable();
              });
            }
            else{
              Schema::table('values', function(Blueprint $table) use($Name) {
              $table->double($Name)->nullable();
              });
            }
    			}
          $Counter++;
        }
  			return view('AddRecords',compact('Columns'));
    		
    }

    public function BackToAdd () {
      $Columns = DB::table('entities')->select('Name', 'Type')->get();
      return view('AddRecords',compact('Columns'));
    }

    public function NewRocord (Request $request){
      $input = Input::except('_method', '_token');
      DB::table('values')->insert($input);
      return redirect()->action('HomeController@BackToAdd', compact('Columns'))->with('message', 'Record Added Successfully');
    }

    public function Edit (Request $request){
      DB::table('entities')->truncate();
      
      for($x = 0; $x < count($request->Name); $x++) {
          DB::table('entities')->insert([
            'Name' =>$request->Name[$x],
            'Type' =>$request->Type[$x],
          ]);
      }
    
      return redirect('/')->with('EditMessage', 'Columns Edited Successfully');
    }

    public function delete (Request $request)
    {
      DB::table('entities')->where('Name', $request->ColumnDelete)->delete();
      return redirect('/')->with('DeletedMessage', 'Column Deleted Successfully');
    }
}
