# ERP_system
ERP system using PHP and MySQL to insert, update, delete and search  system data.

In this project, I made the following assumptions:

    You have basic knowledge of PHP, MySQL, and web development concepts.
    You have XAMPP and Visual Studio Code (VS Code) installed on your local machine.
    The project uses a MySQL database named "assignment" with the necessary tables for customer, item, district, invoice, invoice_master, item_category, item_subcategory.
    You have basic knowledge of setting up a virtual host in XAMPP to run the project locally.

How to Set Up the Project in a Local Environment (XAMPP + VS Code)

Follow these steps to set up the project in your local environment:
Step 1: Clone the Project

    Clone or download the project repository to your local machine.
    Place the project folder inside the "htdocs" folder of your XAMPP installation. For example, the path might be: C:\xampp\htdocs\your_project_folder.

Step 2: Set Up the Database

    Open XAMPP and start the Apache and MySQL services.
    Access phpMyAdmin by typing "http://localhost/phpmyadmin" in your web browser.
    Create a new database named "assignment."
    Import the provided SQL file into the "assignment" database to create the necessary tables and populate some sample data.

Step 3: Configure the Database Connection

    Open the project folder in Visual Studio Code.
    Locate the database connection configuration file, which might be in a separate file or within the PHP files that interact with the database (e.g., db_connection.php).
    Update the database credentials in the connection file to match your local MySQL server configuration (servername, username, password, and database).

Step 4: Access the Project

    Now you should be able to access the project in your web browser using the URL http://your-project.local. You can navigate through the different pages and test the functionality of the web application.
    Project Structure

Here's a brief overview of the project structure:

    createCustomer.php: Add a new customer to the database.
    displayCustomer.php: View the list of customers.
    updateCustomer.php: Update customer details.
    deleteCustomer.php: Delete a customer from the database.
    createItem.php: Add a new item to the database.
    displayItem.php: View the list of items.
    updateItem.php: Update Item details.
    deleteItem.php: Delete a item from the database.
    displayInvoiceReport.php: View the invoice report.
    displayInvoiceItemReport.php: View the invoice item report.
    displayItemReport.php: View the item report.