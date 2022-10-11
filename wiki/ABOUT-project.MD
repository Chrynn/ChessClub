## About
- From UX point of view the design is not the best, but it should be enough for code presentation

### Login section
- First you can do is login into user section trought login form

Login form
- Login form requires you to log in by your `username` and `password`

> There are available accounts you can log for test purposes
> - Accounts can be found in `app/Database/Fixture/content/user.neon`

- For you is created account with nickname `webwings` and password `webwings123`

Safety features
- Make sure you are putting right nickname and password, because if you are not registered in Database you will not be able to get in
- You can not visit user section before login

> Try to visit User section from URL - delete login from URL
> - You should be redirected back to login section