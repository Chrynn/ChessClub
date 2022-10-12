## Beginning

- project is using LINUX commands so its recommended to use `Linux` Subsystem or `Virtual OS` like for example `ubuntu`

### Clone repository

- `clone` project from Github repository
- you can use HTTPS (need to set git identity) or SSH link (need to generate SSH key)
- I personally recommend SSH but its on you

```
git clone git@github.com:Chrynn/Chess-Club.git
```

### Starting the project
> now we got main project files, but we need to add a few things

- Create `local.neon` file into `config` folder with content below
- You can use `touch` and then `nano` commands or do it manually

```
parameters:

database:
    dsn: 'mysql:host=127.0.0.1;dbname=test'
    user: root
    password: root
```

- Call Makefile command `make start` which will:
1. setup Docker container and image
2. give required permissions to `log` and `cache` folders
3. setup composer extensions as `vendor` folder
4. fill database with test data

```
make start
```
- Now find the project properly running in browser on URL address `localhost:90` and database on `localhost:10000`
- **Make sure** you do not have running some other project on port with number `90`
> We finished, good luck with project testing!

- If you want to turn project off call `make down` command
```
make down
```
- Then to turn on back call `make up`
```
make up
```