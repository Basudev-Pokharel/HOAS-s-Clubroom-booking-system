# Clubroom booking system for our building
> Dedicated to the community members

**Go to live Link** [here](https://hoas-s-clubroom-booking-system.onrender.com/login)

_I made this from scratch to this, all by myself_


This is the booking system for the people of Aisakkaankatu building. In HOAS's booking system there is no booking system for `Clubroom` so I thought to make one such system so everyone in this building can book and enjoy clubroom slots.

## Features
- Admins can see the people who booked the slots of the `Clubroom` and cancel their bookings as well.
- People can login and logout
- Completely Mobile responsive. In fact this is mobile first design and not even well optimized for the laptops or screen > mobile screens.
- People can book slots without login and logging out but with the their address data & Name.
- See available vacant slots
- People can find out the members who has key of the clubroom 

## Technology(Full Stack App)
- Laravel (Backend)
  - Authentication
  - ORM(Object Relational Mapping)
- CSS (Tailwind CSS)
- JS (Javascript)

## Test Credentials
If you are curious to test please use this credentials:
```js
# Ordinary Member                 |    # Admin Member
email: james.wilson@example.com   |     email: maria.garcia@example.com 
password: password123             |     password: password123 
```

## Steps to Run
**Requirements :** MySQL, PHP, Composer
```bash
# Clone the repository
git clone https://github.com/Basudev-Pokharel/HOAS-s-Clubroom-booking-system.git

# Go to the directory
cd HOAS-s-Clubroom-booking-system

# Install all the dependencies, and make sure you have composer and PHP is in your system or environment, 
composer i  # This will take time, don't Panick, composer is a bit slow

# copy environemnt file, make sure the .env exists before doing forward steps
cp .env.example .env

# generate the app key for security reason, without it app won't work
php artisan key:generate 
 
# run migration, ⚠⚠⚠⚠ Your database must running, otherwise it will give error
php artisan migrate --seed

# INstall Tailwinds's dependencies
npm install
npm run dev

# FInal runnig command,⚠⚠⚠⚠ Make sure your database is running
php artisan serve

```
