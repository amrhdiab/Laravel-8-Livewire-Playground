## Laravel 8 Livewire Playground
<p float="left">
  <img src="screenshots/Laravel-Livewire-screenshot 1.jpg" height="250" width="400">
  <img src="screenshots/Laravel-Livewire-screenshot 2.jpg" height="250" width="400">
</p>
Here, i'm just playing around with Laravel Livewire, getting used to it since its fairly new. But feel free to download, or forking it. I am using Laravel V 8.18.1 with basic bootstrap scaffolding on top.

## What I Did So Far
- Full CRUD for the posts model with pagination.
- Live search, order by, order direction, and number of posts shown. Basically a "live-wired" DataTable.
- Bootstrap modals for each of the used forms.
- Image upload.
- Ability to multiple select records, and perform a bulk delete or a bulk edit.
- Wanted to test out how the authorization works in live wire, so i created a simple Policy for the Posts model.
- Simple message flashing.
- Post, User, and Category model factories, and seeds.

## TO-DO 
- Dependent drop-down lists with live wire.
- Charts made with livewire.
- Might start experimenting a bit with AlpineJS.

## Installation
Well, it is not a package so, just clone/download the repo, and then:
- run `composer install`
- run `php artisan migrate --seed`
- Register a new user or login.
- Head to the dashboard "/home" route.
