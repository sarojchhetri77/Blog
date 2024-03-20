# Blog Management System

A web application for managing blogs and categories.

## Features

- CRUD operations for blogs
- CRUD operations for categories
- Api to list the categories
- Api to filter the blog based on the category
- Api to search the blog based on the name

## Installation

1. Clone the repository:
  git clone https://github.com/sarojchhetri77/Blog.git


2. Install dependencies:
    composer update

3. Set up the environment variables:
    copy .env.example and paste and rename .env:
   php artisan key:generate

4. Configure the database in the `.env` file.
  

5. Run migrations and seed the database:
     php artisan migrate:fresh --seed

6. For admin dashboard
    type: admin/dashboard in url     
