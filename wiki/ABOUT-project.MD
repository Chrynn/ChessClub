## About
- From `UX` point of view the design is not the best, but should be enough for code presentation
- I tried to keep frontend simple using `SASS` and `latte`
- CSS classes are named by [BEM Standard](https://www.devbridge.com/articles/implementing-clean-css-bem-method/) (except of Nette forms)
- Website is mostly [responsive](https://www.w3schools.com/html/html_responsive.asp) except of tables
- Backend is programmed by PHP which I tried to keep code as clean as possible

> PHP

- I used Nette forms for this website despite I prefer to use custom forms
- Every form has own [DTO](https://en.wikipedia.org/wiki/Data_transfer_object)
- Every query has own method called service
- Every method that changes some content is called as Facade
- You can run your app without any kind of Match data because there is on the frontend side data availability validation

> Database

- I kept database simple with only important data like result of the game
- Database data are only results of the games, that are calculated by method where the parameter are game stats
- If you want to visit database (localhost port is mentioned in `START-prokect.MD` file) use login details from `local.neon` file

### Login section
- First you can do is login into user section trough login form

**Login form**
- Login form requires you to log in by your `username` and `password`
- For you is created account with nickname `webwings` and password `webwings123`

> There are available accounts you can log for test purposes
> - Accounts can be found in `app/Database/Fixture/content/user.neon`

**Safety features**
- Make sure you are putting right nickname and password, because if you are not registered in Database you will not be able to get in
- You can not visit user section before login

> Try to visit user section from URL address - delete login from URL
> - Webpage should make you redirect back to login section

### User section
> User section is created by three pages:
> - Dashboard
> - Top players
> - Settings

**Dashboard**
- You can see your game data like `wins`, `loses`, `wins as black & white`
- Under these stats is `your best performance` in the least possible number of moves (winner steps must be one less than player who lost)

**Top players**
> Space for the best of all
- Table with the `best match performance` by count of moves
- Table with the `worst match performance` by count of moves
- Behind these tables stands table that displays `Top 10 players` based on number of wins with rule playing at least ten times as white & black color of figure

**Settings**
- The place where you can edit your account details like `Forename`, `Surname`, `Phone number` and `password`
- `Nickname` is only shown, but not available for edit purpose
- Forename and Surname are basically `strings` but phone number must be `number` (there is a value type valdiation)

> if you read this far I want to thank you for the time you spend with reading and trying this project