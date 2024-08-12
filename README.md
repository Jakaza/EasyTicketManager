# EasyTicketManager
 
## Ticket Reservation System with QR Code Integration

### Overview

**Ticket Reservation System with QR Code Integration** is a web-based application designed to help tour and activity operators manage client reservations and bookings. Built using HTML, CSS, JavaScript, and PHP/MySQL, this system provides a secure and user-friendly platform for handling ticket sales and event management.

## Features

- **QR Code Integration:** Enhances security and privacy for client information with unique QR codes for each ticket.
- **Responsive Interface:** Adapts seamlessly to various devices, ensuring a smooth user experience.
- **Customizable:** Easily configurable to meet different operational needs.
- **Comprehensive Dashboard:** Provides an overview of events, seats, and ticket sales.
- **Event and Seat Management:** Allows for adding, editing, and deleting events and seats.
- **Ticket Sales Tracking:** Monitors and manages ticket sales efficiently.

## Installation

### Prerequisites

- PHP 7.4 or later
- MySQL 5.7 or later
- Web Server (e.g., Apache or Nginx)
- Composer (optional, for PHP dependency management)

  Or
- XAMPP for all in one Development


### Setup

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/yourusername/ticket-reservation-system.git
    ```

2. **Navigate to the Project Directory:**

    ```bash
    cd EasyTicketManager
    ```

3. **Create a Database:**

    Create a MySQL database named `qrCodeGen` and import the provided SQL schema into it.

4. **Configure Database Connection:**

    Open the `dbcon.php` file and configure your database connection settings:

    ```php
    <?php
    $conn = new PDO('mysql:host=localhost;dbname=qrCodeGen', 'root', '');
    ?>
    ```

## Usage

### Dashboard

- **Quick Count:** View total events, seats, and tickets.
- **Sell Tickets:** Manage ticket sales.
- **Generate and Print Tickets:** Create and print tickets with QR codes.

### Sold Tickets

- **Track Sales:** View tabulated data of sold tickets per event.

### Event Preferences

- **Add Events:** Create new events.
- **Edit/Update Events:** Modify existing events.
- **Delete Events:** Remove events from the system.

### Seat Preferences

- **Add Seats:** Define new seat configurations.
- **Edit/Update Seats:** Update existing seat details.
- **Delete Seats:** Remove seat configurations.

## Technology Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **QR Code Generation:** Integrated through PHP libraries

## Contributing

## License

## Contact

For any questions or support, please contact:

- **Email:** goodnessthembac@gmail.com
- **GitHub:** [jakaza](https://github.com/jakaza)
