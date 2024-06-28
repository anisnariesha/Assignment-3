<!DOCTYPE html>
<html>
<head>
    <title>HealthClinic</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel='stylesheet' href='service.css'>
</head>

<body>
    <!-- header -->
    <header>
        <a class="logo"><i class='bx bx-health'></i>HealthClinic</a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="login.php" onclick="logout(event)">Logout</a></li>
        </ul>
    </header>
    
    <!-- home -->
    <section class="home" id="home">
        <div class="home-text">
            <h1>HealthClinic</h1>
            <p>Your path to vitality and well-being starts here at HealthClinic.</p>
        </div>
    </section>

    <!-- services -->
    <section class="services" id="services">
        <div class="text">
            <h2>Services offered by us:</h2>
        </div>

        <div class="card-list" id="service-container">
            <?php
                session_start();
                require_once "database.php";

                // Fetch services data from database
                $sql = "SELECT services_name, services_description, services_price, services_image FROM services";
                $result = $conn->query($sql);

                // Fetch and display services dynamically
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $serviceName = htmlspecialchars($row["services_name"]);
                        $serviceDescription = htmlspecialchars($row["services_description"]);
                        $servicePrice = htmlspecialchars($row["services_price"]);
                        $serviceImage = base64_encode($row["services_image"]);
                        $imageSrc = 'data:image/jpeg;base64,' . $serviceImage;

                        // Output HTML for each service dynamically
                        echo '<div class="card" 
                                data-service-name="' . $serviceName . '"
                                data-service-description="' . $serviceDescription . '"
                                data-service-price="' . $servicePrice . '"
                                data-service-image="' . $imageSrc . '"
                                onclick="openModal(this)">
                                <div class="content-img">
                                    <img src="' . $imageSrc . '" alt="' . $serviceName . '">
                                </div>
                                <h4>' . $serviceName . '</h4>
                            </div>';
                    }
                } else {
                    echo "No services found.";
                }

                // Close connection
                $conn->close();
            ?>
        </div>
        
        <!-- The Modal -->
        <div id="serviceModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div id="modalContent">
                    <!-- Content will be dynamically populated here -->
                </div>
                <div class="modal-footer">
                    <button class="modal-close-btn">&times; Close</button>
                </div>
            </div>
        </div>

    </section>

    <!-- footer -->
    <footer id="contact">
        <div class="end-text">
            <p>Copyright ©2024 HealthClinic. All rights reserved.</p>
        </div>
    </footer> 
    
    <!-- link to js -->
    <script type="text/javascript" src="script.js"></script>
    <script>
        function logout(event) {
            // Prevent the default action of the anchor tag
            event.preventDefault();

            // Display a confirmation dialog
            var logoutConfirmed = confirm("Are you sure you want to logout?");
            
            // Check the result of the confirmation dialog
            if (logoutConfirmed) {
                // User clicked "OK", proceed with logout
                window.location.href = "login.php";
            } else {
                // User clicked "Cancel", do nothing or provide feedback
                // For example, you could show an alert to confirm the action was cancelled
                alert("Logout cancelled.");
            }
        }
    </script>
</body>
</html>
