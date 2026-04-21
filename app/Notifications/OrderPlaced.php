<?php
namespace App\Notifications;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPlaced extends Notification
{
    public $order;
    public function __construct($order) { $this->order = $order; }
    public function via($notifiable) { return ['database']; }
    public function toArray($notifiable) {
        return ['order_number'=>$this->order->order_number,'status'=>$this->order->status,'total'=>$this->order->total_amount];
    }
}