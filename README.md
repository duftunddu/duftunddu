# Duft Und Du (Frangrance & You) 🎩

# Meta

I went from providing reviews on YouTube, to automating the entire process.
This was my FYP, and my 2nd project using laravel.

<br/>

Independently created, modified, tested, and maintained the code.
Trained and deployed the AI model on minimal data that I gathered myself. Covid killed the perfume side completely, and with it, this project.

> ## Provides AI-powered personalized fragrance reviews and recommendations.

<br/>

> All data was live. There's no dummy data. 🤭
>
> But you can still waste your time by setting up a local server.

<br/>

## B2B 👔

Designed APIs to be used by fragrance webstores to show personalized fragrance reviews directly on the product page.

<br/><br/>

# Frameworks

## Tech

-   `Laravel`
-   `Node(npm)`
-   `PHP`
-   `MySQL`
-   `Python`
-   `Sklearn`

<br/>

## Team/Efficiency

-   JIRA
-   Toggl Track

<br/><br/>

# Everything I Developed & Learnt

-   End-to-end Data Pipelines
-   Data Analysis
-   Brand Dashboard
-   Disposable Email Guard
-   Bulk Email System from Scratch
-   CSV/Excel Import/Export
-   Conda Envs
-   Merchant APIs

<br/><br/>

# Video

[![Watch the video](https://img.youtube.com/vi/nF8kMjy6sg8/maxresdefault.jpg)](https://youtu.be/nF8kMjy6sg8)

<br/><br/>

<details>
  <summary><h1>Screenshots (Click on me!)</h1></summary>
  <summary>Search</summary>
  <img src="https://i.postimg.cc/6p5GVkcW/landing.png" name="search">
  <summary>About Us</summary>
  <img src="https://i.postimg.cc/vTr6XMCB/about-us.jpg" name="about-us">
  <summary>Franrance Review Template</summary>
  <img src="https://i.postimg.cc/bN0Q9HjT/fragrance-review-template.jpg" name="fragrance-review-template">
  <summary>Franrance Review</summary>
  <img src="https://i.postimg.cc/jSFCHLCc/fragrance-review.jpg" name="fragrance-review">
  <summary>Shop</summary>
  <img src="https://i.postimg.cc/kgfKkJGR/shop.jpg" name="shop">
  <summary>Sign Up</summary>
  <img src="https://i.postimg.cc/5trv2swx/sign-up.png" name="sign-up">
  <summary>User Profile</summary>
  <img src="https://i.postimg.cc/Bb9KxtYk/user-profile.png" name="user-profile">
  <summary>Online Store</summary>
  <img src="https://i.postimg.cc/RZMws6Sz/online-store.jpg" name="online-store">
</details>
</details>

<br/><br/>

# Setting up Local Server

## 1. Install NVM

Follow this [guide](https://www.freecodecamp.org/news/node-version-manager-nvm-install-guide/) to set up NVM.

[Stack overflow](https://stackoverflow.com/questions/74548318/how-to-resolve-error-error0308010cdigital-envelope-routinesunsupported-no) thread on the same topic: No need for it, it's only here as a backup.

<br/>

NVM can also be found here. Click on Download now, and download and install the setup:

[Github | Corey Butler | nvm-windows](https://github.com/coreybutler/nvm-windows#readme)

<br/>

## 2. Use Node Version 16

Restart your code editor after installing.

Find the current version of node by:

```sh
nvm current
```

copy and paste in place of X.Y.Z to make your current version the default one:

```sh
nvm alias default vX.Y.Z
```

Example:

```sh
nvm alias default v18.17.1
```

Install node 16:

```sh
nvm install 16.0.0
```

List the installed node versions:

```sh
nvm list
```

Use node 16:

```sh
nvm use 16.0.0
```

Again to check:

```sh
nvm current
```

<br/>

## 3. Install WAMP, XAMP or LAMP

Install [wamp](wamp.org)

You may need to do either or both of these, depending on what you are using:

Add or remove from system path in environment variables:

```c
C:\xampp\php
```

Add or remove from system path:

```c
C:\wamp64\bin\php\php7.4.33\
```

<br/>

## 4. Install Laravel

```php
composer global require laravel/installer
composer update --no-scripts
```

<br/>

## 5. Set up Local Repository

Download the repo, and do the following:

-   Create database in phpmyadmin.
-   Create .env file from the example.env file in the repo.
-   Set database variable in .env.

<br/>

In case you need any new env vars, you can find them here:  
[Example laravel env](https://github.com/laravel/laravel/blob/master/.env.example)

<br/>

## 6. Install npm modules

```sh
npm install
```

<br/>

## 7. Run the following commands

```php
php artisan cache:clear
php artisan config:clear
composer install
composer dump-autoload
php artisan key:generate
php artisan config:cache
```

Run migrations and seed the db:

```php
php artisan migrate:refresh
php artisan db:seed
```

## 8. Start local server

```php
php artisan serve
```

It'll be served at:
http://localhost:8000

<br/><br/>

# No Live Deployment

Was deployed on a VPS. Requires too big cache size for serverless, and I simply can't be bothered to deploy it as I've moved to `React`.

<br/>⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⣠⣤⣶⣶
<br/>⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⢰⣿⣿⣿⣿
<br/>⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⣀⣀⣾⣿⣿⣿⣿
<br/>⣿⣿⣿⣿⣿⡏⠉⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⣿
<br/>⣿⣿⣿⣿⣿⣿⠀⠀⠀⠈⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠛⠉⠁⠀⣿
<br/>⣿⣿⣿⣿⣿⣿⣧⡀⠀⠀⠀⠀⠙⠿⠿⠿⠻⠿⠿⠟⠿⠛⠉⠀⠀⠀⠀⠀⣸⣿
<br/>⣿⣿⣿⣿⣿⣿⣿⣷⣄⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿
<br/>⣿⣿⣿⣿⣿⣿⣿⣿⣿⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⣴⣿⣿⣿⣿
<br/>⣿⣿⣿⣿⣿⣿⣿⣿⡟⠀⠀⢰⣹⡆⠀⠀⠀⠀⠀⠀⣭⣷⠀⠀⠀⠸⣿⣿⣿⣿
<br/>⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠈⠉⠀⠀⠤⠄⠀⠀⠀⠉⠁⠀⠀⠀⠀⢿⣿⣿⣿
<br/>⣿⣿⣿⣿⣿⣿⣿⣿⢾⣿⣷⠀⠀⠀⠀⡠⠤⢄⠀⠀⠀⠠⣿⣿⣷⠀⢸⣿⣿⣿
<br/>⣿⣿⣿⣿⣿⣿⣿⣿⡀⠉⠀⠀⠀⠀⠀⢄⠀⢀⠀⠀⠀⠀⠉⠉⠁⠀⠀⣿⣿⣿
<br/>⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠈⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⣿
<br/>⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿
