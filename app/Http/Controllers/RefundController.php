<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RefundController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if( Auth::user()->role == "Admin" || Auth::user()->role == "Viewer" ){
            $refunds = Refund::orderByDesc( 'id' )->paginate( 15 );
        }else{
            $refunds = Auth::user()->refund()->paginate( 15 );
        }

        return view( 'refund.all-refunds', [
            'allRefunds' => $refunds,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view( "refund.add-refund" );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {

        if ( $request->image ) {
            $image = $request->image->store( 'refunds', 'public' );
        } else {
            $image = null;
        }
        // dd($image);
        Refund::create( [
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $image,
            'user_id'       => Auth::user()->id,
        ] );
        // asset( 'storage/' . $image )
        return redirect()->back()->with( 'applied', 'Applied Successfully' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Refund $refund ) {
        return view( "refund.show-refund", [
            'refund' => $refund,
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Refund $refund ) {

        $refund->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with( 'update', 'Updated Successfully' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Refund $refund ) {
        Storage::disk('public')->delete($refund->image);

        $refund->delete();

        return redirect()->route("refund.index")->with( 'delete', 'Deleted Successfully' );
    }

}
