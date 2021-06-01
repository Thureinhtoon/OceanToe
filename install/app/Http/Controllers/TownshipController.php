<?php

namespace App\Http\Controllers;

use App\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    public function index(){
       $townships =  Township::all();
       return view('backend.township.index',compact('townships'));
    }

     public function create()
    {
       $townships = Township::all();

        return view('backend.township.create',compact('townships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
          
        

        Township::create([
            
            'name' =>$request->township_id,
            'delivery_price' => $request->price,
           

        ]);
        return redirect('/township')->with('message','You have successfully changed your comment status');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $comments = Comment::where('post_id',$id)->get();
    //     return view('admin-panel.posts.comment',compact('comments'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {
       
        $township = Township::find($id);
        return view('backend.township.edit',compact('township'));
    }

     public function update(Request $request, $id)
    {
       

        $township = Township::find($id);

       
        $township->update([
            'name' => $request->township_id,
            'delivery_price' => $request->price,
            

        ]);
       
       return redirect ('/township')->with('message','You have successfully updated!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
   
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    $township = Township::find($id);

   
    $township->delete();
    return redirect('/township')->with('message','You have successfully deleted!');
}

    }

   
