# Laboratory Activity 12 – Make the Failures Yours

## H1. Exception Trace

The error page showed a file inside the `vendor` folder because Laravel's own code was handling the invalid method call. However, my actual mistake was in my `MovieController.php`, where I accidentally added an extra letter to the `with()` method. I found the exact location of my mistake by opening the Exception Trace and checking the frame that pointed to my controller.

## H2. Logging with Context

My `Log::info()` line with a context array allows me to identify which movie record was saved by checking its ID in `laravel.log`. Next month, I can still look at the log and determine the specific movie record involved, even when the original success message is no longer visible on the page.

## H3. 403 Forbidden vs. Redirect with a Message

I used a 403 Forbidden response when a movie is the last remaining movie in its genre because deleting it would leave that genre without any movies. I would use a redirect with a message when an action is not allowed but the user can still correct the situation and continue using the application without being denied access to the request entirely.