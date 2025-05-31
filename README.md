# MAC Address Whitelisting & Blacklisting Module

## 📌 Overview

This Laravel-based module allows for centralized control of device access using MAC address whitelisting and blacklisting. Administrators can add, approve, reject, and manage MAC address entries. A configurable `.env` setting provides a bypass mode for development or emergencies.

## 🚀 Features

- Add, edit, and manage MAC address entries
- Configurable bypass mode for whitelisting/blacklisting via .env
- Search entries by MAC address, type, or description
- Ability to clear all MAC address entries from the module

## ⚙️ Technologies Used

- **Laravel**
- **MySQL**
- **Fast Bootstrap**
- **jQuery**


## Installation

Follow these steps to install and configure Laralogger:

1. **Clone the Repository**

   ```bash
   git clone <repository_link>
   ```
2. **Navigate to the Project Directory**
   ```bash
   cd <project_name></project_name>
   ```
3. **Install Dependencies**
   ```bash
   composer install
   ```
4. **Duplicate .env.example to .env and configure your database and other settings.**
   ```bash
   cp .env .env.example

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Configure Env File**
7. **Run Migrations (if applicable)**
   ```bash
   php artisan migrate
   ```
8. **Redirect to Landing Page**
   ```bash
   http://localhost:8000/mac-addresses
   ```
   or
   ```bash
   http://127.0.0.1:8000/mac-addresses
   ```
9. **Enjoy!**

## Contact
For questions or support, please contact:
* Email: joshuayaacoub33@gmail.com
* LinkedIn: https://www.linkedin.com/in/joshua-maurice-yaacoub/
