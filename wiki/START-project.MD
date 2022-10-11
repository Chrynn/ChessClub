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

- call `make up:build` for build Docker images (required for first time)
```
make up:build
```
- call `make up` to start project on `localhost:90`
```
make up:build
```

- create folder `log` for Nette error messages
```
mkdir log
```

- create folder `cache` for Nette stuff (containers etc.)
```
mkdir cache
```
- call Makefile command `make start` which will:
1. give required permissions to the folders we created
2. setup composer extensions

```
make start
```

- call `make init` to put data into Database
```
make init
```
