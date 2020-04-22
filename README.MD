# Demo App

This is a demo app to demonstrate a few skills:

* Secure Login / Signup
* Writing a REST API with client authentication (Bearer)
* Outputting JSON data with strings, integers, booleans, and null properties
* Working with a public REST API (randomuser.me)
* JavaScript `fetch` to load remote data
* Browser Push Notifications with the Notifications API
* Work without any frameworks

## Setup and Installation

To setup and install, you'll need to import the `schema.sql` file to a MySQL
database. You'll also need to create a `.env` file for environment variables.
See `sample.env`.

## Bearer Tokens

The API (`/api/user`) requires a valid Bearer token. You can get a token once
you log in and visit the "Tokens" section.

## Improvements To Be Made

* Better CSS
* Unit Testing
* Email verification for account creation
* Better security features (2FA)
* A bit more effort in tidying up and refactoring a bit of code for readability
and consistancy.
* Full PHPDoc

## Thoughts On The Project

I haven't written pure vanilla JS and PHP in a very long time. It was super
interesting to apply what I've learned over the last decade (OOP, Middleware,
MVC-style design, aspects of functional programming) without the use of
frameworks and other third party tools.
