<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewAuthorGallery extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($gallery)
    {
        //
        $this->gallery = $gallery;
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
        return (new MailMessage)
                    ->greeting('Hallo, Admin !!')
                    ->subject('Approve Gallery')
                    ->line('Ada Gallery baru dari '.$this->pogalleryst->user->name . ' perlu di approve')
                    ->line('Judul Gallery : '.$this->gallery->title)
                    ->line('Klik tombol dibawah kalo mau approve.')
                    ->action('Liat Gallery', url(route('admin.gallery.show',$this->gallery->id)))
                    ->line('Terima kasih banyakkk!!');
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
