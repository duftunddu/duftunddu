<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\Mailer;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\OrderShipped;

use Illuminate\Mail\Markdown;
use Illuminate\Container\Container;
// use App\Order;
// use Illuminate\Support\Facades\Mail;

class Email_Master_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct() {
        $this->middleware('auth');
    }

    public function panel()
    {
        return view('admin.email_panel');
    }
    
    public function template_show(Request $request)
    {
        $markdown = Container::getInstance()->make(Markdown::class);

        $html = $markdown->render("emails.{$request->email_template}");

        return view('emails.empty',[
                'html' => $html,
            ]);
        // return Markdown::("emails.{$request->email_template}")->render();

        // return view('emails.template',[
        //     'blade_name' => $request->email_template,
        // ]);
    }

    public function send(Request $request)
    {
        // $order = Order::findOrFail($orderId);

        // Ship order...
        // echo "somthing";
        // var_dump($request->name);
        //     return;

        // Mail::to($request->user())->send(new OrderShipped($request));
        // Mail::to($request->address_to)->send(new OrderShipped($request));

        var_dump($request->email_template_name);
        var_dump($request->address_from);
        var_dump($request->address_to);
        return;
        return redirect()->back();
    }
    public function some()
    {

        // return (new App\Mail\OrderShipped())->render();
        // return markdown('emails.order_shipped');

        // return OrderShipped();

        // $order = Order::findOrFail($orderId);

        // Ship order...
        // echo "somthing";
        // var_dump($request->name);
        //     return;

        // Mail::to($request->user())->send(new OrderShipped($request));
        // Mail::to($request->address_to)->send(new OrderShipped($request));

        // var_dump($request->email_template_name);
        // var_dump($request->address_from);
        // var_dump($request->address_to);
        // return;
        // return redirect()->back();
    }

}
