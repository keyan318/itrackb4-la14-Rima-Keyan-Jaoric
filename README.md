# Lab Activity 14 — Locking the Front Door

## Part F — README

### F1. Authentication and Authorization

This lesson taught me how to implement authentication in my Movie App, allowing users to register, log in, and log out securely. Authorization is still something I need to learn further, especially how to control what specific authenticated users are allowed to do.

### F2. Session Regeneration

I learned that `session()->regenerate()` creates a new session ID after a successful login to help prevent session fixation attacks. If I skip it, an attacker may be able to exploit an existing session ID and compromise a user's session.

### F3. Generic Login Error

I used the same error message for an incorrect password and an email that does not exist to prevent attackers from identifying registered accounts. This makes my login page safer because it does not reveal which email addresses are registered in my Movie App.

### F4. Public and Protected Routes

I kept the `index` and `show` pages public because visitors should be able to browse the movie list and view movie details without logging in. I protected `create`, `edit`, `update`, and `destroy` because these routes allow users to add, modify, or delete movie records.

### F5. Hiding Buttons Is Not Security

I hid the Add, Edit, and Delete buttons from guests to prevent them from seeing the movie management controls in the interface. However, hiding these buttons is not enough because someone can manually enter the URL, so I used the `auth` middleware to block unauthorized access to the protected routes.

### F6. Login Route Name

I learned that Laravel's authentication middleware looks for a route named `login` when redirecting unauthenticated users to the login page. If I rename the route, Laravel cannot find the expected route and will throw a `Route [login] not defined` error.
