# Codexial Project

## Description
Codexial is a project developed as a two-day solo exercise. It's designed as an application for pharmacy representatives, enabling them to record the number of boxes sold in a pharmacy each day. The application also includes an admin panel for reviewing these sales data.

## Getting Started

These instructions will guide you on how to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
- PHP 7.4 or higher
- MySQL
- Composer

## Steps

1. **Clone the Repository**
    ```
    git clone https://github.com/bugBuster42/Codexial.git
    ```

2. **Install PHP Dependencies**
   
    Navigate to the cloned repository directory:
    ```
    cd Codexial
    ```
    and run:
    ```
    composer install
    ```

3. **Database Configuration**
   
    - **Update the `.env.local` File for Database Connection**:
        - Navigate to your project directory and locate the `.env.local` file.
        - Uncomment the MySQL database URL line and comment out the PostgreSQL line:
          ```
          # Comment this line if using PostgreSQL
          #DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
          
          # Uncomment and update this line for MySQL
          DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"
          ```
        - Replace `app`, `!ChangeMe!`, and `app` in the uncommented line with your MySQL username, password, and database name, respectively.

    - **Create a MySQL Database**:
        - Open your Terminal.
        - Connect to MySQL:
          ```
          mysql -u [username] -p
          ```
        - Create a new database:
          ```
          CREATE DATABASE [database_name];
          ```
        - Replace `[username]` and `[database_name]` with your MySQL username and the name of the new database.

    - **Run Database Migrations (if applicable)**:
        - Apply migrations to set up the database structure:
          ```
          symfony console d:m:m
          ```

    - **Load Data Fixtures**:
        - Load the data fixtures to populate the application with sample data:
          ```
          symfony console d:f:l
          ```
4. **Run the Application**
    - Start the Symfony server:
      ```
      symfony server:start
      ```

5. **Access the Application**
    - Open `http://localhost:8000` in your browser to interact with the application.

## Additional Information

- This project was developed as a practice exercise and may not include all functionalities of a complete application.
- The data generated by fixtures is for demonstration purposes and can be modified or extended as needed.
