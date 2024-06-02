# NoteSync

NoteSync is a web application designed for sharing and managing notes. Users can create accounts, log in, upload notes with file attachments, and search for notes by title. The application also supports user and admin functionalities for managing content and user roles.

## Features

- **User Registration and Authentication**: Secure user registration and login functionality.
- **Profile Management**: Users can update their profile information.
- **Note Upload**: Users can upload notes with file attachments.
- **Search Functionality**: Users can search for notes by title.
- **Note Deletion**: Users can delete their own notes.
- **Admin Module**: Admins can manage users, categories, and notes.

## Technologies Used

- **Frontend**: HTML, CSS
- **Backend**: PHP
- **Database**: MySQL

# To run the NoteSync Project using PHP and MySql:

1. Download the the zip file 
2. Extract the file and copy 'notes_app' folder
3. Paste inside root directory(for xampp xamp/htdocs, for wampp/www,fpr lamp var/www/html)
4. Create a database with name 'notes_app' in phpMyAdmin panel
5. Import NoteSync.sql file into notes_app database.
6. # Usage

**Registration**

Navigate to register.php to create a new user account.

**Login**

Navigate to login.php to log in to the application.

**Dashboard**

After logging in, you will be redirected to the dashboard (dashboard.php).
From the dashboard, you can upload new notes, search for notes, and delete your own notes.

**Sample Data**

The NoteSync.sql file includes sample data:

5 users with hashed passwords.
5 notes associated with the sample users.

To use these credentials:

testuser1: password1
testuser2: password2
testuser3: password3
testuser4: password4
testuser5: password5

# License

This project is licensed under the MIT License - see the LICENSE file for details.