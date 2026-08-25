<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::orderByDesc('created_at')->get();
        return view('admin.messages', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    public function toggleShow(Message $message)
    {
        $message->is_shown = !$message->is_shown;
        $message->save();

        $statusText = $message->is_shown ? 'تم إظهار الرسالة في الصفحة الرئيسية بنجاح' : 'تم إخفاء الرسالة من الصفحة الرئيسية بنجاح';
        return redirect()->back()->with('success', $statusText);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح');
    }
}
