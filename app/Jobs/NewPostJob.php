<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\Website;
use App\Models\SentPost;
use App\Mail\WebsitePost;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NewPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    public $website;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Website $website, Post $post)
    {
        $this->post = $post;
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new WebsitePost($this->post);

        $sentTo = SentPost::where('post_id', $this->post->id)->pluck('email');
        $recipients = Subscriber::whereNotIn('email', $sentTo)
                            ->where('website_id', $this->website->id)
                            ->pluck('email');

        foreach ($recipients as $recipient)
        {
            Mail::to($recipient)->send($email);

            if (!Mail::failures())
            {
                SentPost::create([
                    'post_id'       =>  $this->post->id,
                    'email'         =>  $recipient
                ]);
            }
        }
    }
}
