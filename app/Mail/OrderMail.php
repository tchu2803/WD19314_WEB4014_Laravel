<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Tạo một instance mới.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Xây dựng nội dung email.
     */
    public function build()
    {
        return $this->subject('Xác nhận đơn hàng #' . $this->order->id)
                    ->view('emails.confirmation');
    }
}
