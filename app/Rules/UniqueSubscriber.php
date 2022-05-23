<?php

namespace App\Rules;

use App\Models\Website;
use App\Models\Subscriber;
use Illuminate\Contracts\Validation\Rule;

class UniqueSubscriber implements Rule
{
    public $website;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Website $website)
    {
        $this->website = $website;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exists = Subscriber::where('website_id', $this->website->id)->where('email', $value)->first();

        return !$exists;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email address entered is already subscribed.';
    }
}
