<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Website;
use App\Models\SentPost;
use App\Mail\WebsitePost;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPostsToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:send {website}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all website posts to subscribers (no duplicates).';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $website = Website::find($this->argument('website'));

        if ($website)
        {
            $posts = Post::where('website_id', $website->id)->get();

            foreach ($posts as $post)
            {
                $sentTo = SentPost::where('post_id', $post->id)->pluck('email');
                $recipients = Subscriber::whereNotIn('email', $sentTo)
                                    ->where('website_id', $website->id)
                                    ->pluck('email');

                foreach ($recipients as $recipient)
                {
                    Mail::to($recipient)->send(new WebsitePost($post));

                    if (!Mail::failures())
                    {
                        SentPost::create([
                            'post_id'       =>  $post->id,
                            'email'         =>  $recipient
                        ]);
                    }
                }
            }
        }
    }
}
