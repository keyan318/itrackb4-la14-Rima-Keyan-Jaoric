# Laboratory Activity 13 – Open the Front Door

## Part J – Reflection Questions

### 1. Why did I use a HomeController instead of a resource controller?

I used a `HomeController` because my application only needed a custom method to display the homepage. A resource controller is designed to handle the standard CRUD operations, such as `index()`, `create()`, `store()`, `show()`, `edit()`, `update()`, and `destroy()`. I did not need all these methods for my homepage, so using a regular controller was more appropriate.

### 2. Why did my pagination links lose the search term, and how did I fix it?

At first, when I clicked the next page, the pagination links only contained the page number and did not include my search term. Because of this, the controller received the page parameter without the original search value, causing the search results to reset.

I fixed this by adding `withQueryString()` to my pagination:

```php
$items = $query->paginate(6)->withQueryString();
```

This allowed Laravel to preserve the existing query parameters when I navigated between pages.

### 3. Why is allowing an invalid sort value worse than showing an error, and how did I prevent it?

Allowing an invalid sort value is worse because it can cause unexpected behavior or expose the application to unsafe database queries if the value is used directly. Instead of accepting every value from the URL, I created an allowed list containing only `title` and `year`.

I used `in_array()` to check whether the requested sort value was allowed. If the value was invalid, I set the sorting option back to `title`. This allowed the movie list to continue working even when I entered a misspelled sort value in the URL.