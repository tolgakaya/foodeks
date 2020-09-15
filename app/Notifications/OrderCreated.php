<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Order;


class OrderCreated extends Notification implements ShouldQueue
{
    use Queueable;
    private $order;
    private $to;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, $to)
    {
        $this->order = $order;
        $this->to = $to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $orderDetails = $this->order->orderdetails;
        $mailMessage = new MailMessage();
        $hitap = 'Sn. ' . $this->order->address->contact_name;
        $mailMessage->subject('Sipariş alındı');
        $mailMessage->line($hitap);
        foreach ($orderDetails as  $detail) {
            $str = $detail->quantity . ' ' . $detail->option_name . ' ' . $detail->meal_name;
            $mailMessage->line($str);
            if ($detail->extras !== null) {
                foreach (json_decode($detail->extras) as  $ext) {
                    $strExtr = $ext->extra;
                    $mailMessage->line($strExtr);
                }
            }
        }
        $mailMessage->line('Siparişiniz şu adrese teslim edilecek:');
        $mailMessage->line($this->order->address->address);
        $mailMessage->line('Tel: ' . $this->order->address->phone);
        if ($this->to === "mudur") {
            $mailMessage->action('Yeni Sipariş Listesi', route('admin.orders.index', ['status' => 1]));
        }
        $mailMessage->line('Sipariş: ' . $this->order->restaurant->phone);
        $mailMessage->line('Şuradayız: ' . $this->order->restaurant->address);
        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}