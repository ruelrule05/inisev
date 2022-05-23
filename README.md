## Sample Task

Create a simple subscription platform(only RESTful APIs with MySQL) in which users can subscribe to a website (there can be multiple websites in the system). Whenever a new post is published on a particular website, all it's subscribers shall receive an email with the post title and description in it. (no authentication of any kind is required)

MUST:-
- Use PHP 7.* (i.e. use Laravel 8 as Laravel 9 requires PHP 8.0)
- Write migrations for the required tables.
- Endpoint to create a "post" for a "particular website".
- Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
- Use of command to send email to the subscribers.
- Use of queues to schedule sending in background.
- No duplicate stories should get sent to subscribers.
- Deploy the code on a public github repository.

OPTIONAL:-
- Seeded data of the websites.
- Open API documentation (or) Postman collection demonstrating available APIs & their usage.
- Use of contracts & services.
- Use of caching wherever applicable.
- Use of events/listeners.

Note:- 
1. Please provide special instructions(if any) to make to code base run on our local/remote platform.
2. Only implement what is mentioned in brief, i.e. only the API, no front-end things etc. The codes will never be deployed, we just want to see your coding skills. 
3. There isn't a strict deadline. The faster the better, however code quality (and implementing it as mentioned in brief) is the most important. However, of course it shouldn't take more than a couple of hours. 
4. If anything isn't clear, just implement it according to your understanding. There won't be any further explanations, the task is clear. As long as what you do doesn't contradict the briefing, it's fine. 


---

# Instructions

1. clone the repository `https://github.com/ruelrule05/inisev.git`
2. install dependencies `composer install`
3. setup necessary database connection
4. run migration

```
php artisan migrate
```

or

```
php artisan migrate --seed #queue table must be cleared after running this (observer is used; emails will be queued when new post is created)
php artisan queue:clear
```
5. run server `php artisan serve`
6. listen to queue `php artisan queue:listen`

---
## API Endpoints

### Websites
http://127.0.0.1:8000/api/websites

### Posts
http://127.0.0.1:8000/api/websites/<WEBSITE_ID>/posts
```
http://127.0.0.1:8000/api/websites/1/posts
```

Adding new Post
```
METHOD: POST
URI: http://127.0.0.1:8000/api/websites/1/posts
PARAMETERS:
{
    title: 'Post Title',
    description: 'The description of the post'
}
```

### Subscribers
http://127.0.0.1:8000/api/websites/<WEBSITE_ID>/subscribers
```
http://127.0.0.1:8000/api/websites/1/subscribers
```

Adding new Subscriber
```
METHOD: POST
URI: http://127.0.0.1:8000/api/websites/1/subscribers
PARAMETERS:
{
    email: 'name@company.com'
}
```


## Artisan Command

```
php artisan posts:send <WEBSITE_ID:1>
```