<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat; 
use App\Models\ChatDetail; 
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {       
            if(Auth::user()->isCustomer()){
                $chats = Chat::where('kost_seeker_id', Auth::user()->kostSeeker->id)
                ->orderby('updated_at','desc')
                ->get();

                if($chats->count() > 0){
                    $chat = Chat::where('kost_seeker_id', Auth::user()->kostSeeker->id)
                    ->orderby('updated_at','desc')
                    ->first();

                    if($chat){
                        $chat->seeker_status = 1;
                        $chat->save();
                    }

                return view('backend.kostSeeker.chat.index', compact('chats', 'chat'));
                }else{
                    return redirect()->back()->with('warning', __('Anda belum memiliki obrolan'));
                }
            }else{
                $chats = Chat::where('kost_owner_id', Auth::user()->kostOwner->id)
                ->orderby('updated_at','desc')
                ->get();

                if($chats->count() > 0){
                    $chat = Chat::where('kost_owner_id', Auth::user()->kostOwner->id)
                    ->orderby('updated_at','desc')
                    ->first();

                    if($chat){
                        $chat->owner_status = 1;
                        $chat->save();
                    }
                    return view('backend.kostOwner.manageChat.index', compact('chats', 'chat'));
                }else{
                    return redirect()->back()->with('warning', __('Anda belum memiliki obrolan'));
                }
                
            }

            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {       
            if(Auth::user()->isCustomer()){
                $chats = Chat::where('kost_seeker_id', Auth::user()->kostSeeker->id)
                ->orderby('updated_at','desc')
                ->get();

                $chat = Chat::find($id);
                $chat->seeker_status = 1;
                $chat->save();
                return view('backend.kostSeeker.chat.index', compact('chats', 'chat'));
            }else{
                $chats = Chat::where('kost_owner_id', Auth::user()->kostOwner->id)
                ->orderby('updated_at','desc')
                ->get();

                $chat = Chat::find($id);
                $chat->owner_status = 1;
                $chat->save();
                return view('backend.kostOwner.manageChat.index', compact('chats', 'chat'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
