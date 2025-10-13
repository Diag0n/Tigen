<?php
$servername = "localhost";
$username = "root";
$password = ""; // default is empty in XAMPP
$dbname = "tigen";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getProduct($conn, $id) {
    $stmt = $conn->prepare("SELECT nimi, tietoa, hinta FROM tuotteita WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css.css" rel="stylesheet">
    <title>Tigen</title>
</head>
<body>

    <div class="overlay"></div>
    <header>
        <a href="index.php">
            <img src="kuvat/TigenImageLogo.png" alt="Tigen" class="ImageLogo">
        </a>
        <div class="buttons">
            <a href="ostoskori.html">Ostoskori</a>
        </div>
    </header>

    <div class="carousel-container">
        <div class="carousel">
            <?php
            // Define which product IDs belong to carousel items
            $carouselItems = [
                ["id" => 1, "image" => "kuvat/tuotteet/1.jpeg"],
                ["id" => 2, "image" => "kuvat/tuotteet/kengät1m.jpeg"],
                ["id" => 3, "image" => "kuvat/tuotteet/kengät2n.jpg"],
                //["id" => 4, "image" => "kuvat/tuotteet/paita2m.jpeg"],
                ["id" => 5, "image" => "kuvat/tuotteet/paita2m.jpeg"],
                ["id" => 6, "image" => "kuvat/tuotteet/paita3m.jpeg"],
                
            ];

            foreach ($carouselItems as $item) {
                $product = getProduct($conn, $item["id"]);
                echo '<div class="carousel-item">';
                echo '<div class="item-box">';
                echo '<img src="' . $item["image"] . '" alt="' . htmlspecialchars($product["nimi"] ?? "Tuote") . '">';
                if ($product) {
                    echo '<h3>' . htmlspecialchars($product["nimi"]) . '</h3>';
                    echo '<p>' . htmlspecialchars($product["tietoa"]) . '</p>';
                    echo '<p><strong>€' . htmlspecialchars($product["hinta"]) . '</strong></p>';
                } else {
                    echo '<h3>Tuntematon tuote</h3>';
                    echo '<p>Ei tietoja saatavilla</p>';
                }
                echo '</div></div>';
            }
            ?>
        </div>            
        <button class="carousel-button prev">&#8249;</button>
        <button class="carousel-button next">&#8250;</button>
    </div>

    <div class="product-slots">
        <?php
        $sql = "SELECT id, nimi, tietoa, hinta, kuva FROM tuotteita";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product-slot">';
                echo '<img src="kuvat/tuotteet/' . htmlspecialchars($row["kuva"]) . '" alt="' . htmlspecialchars($row["nimi"]) . '">';
                echo '<h3>' . htmlspecialchars($row["nimi"]) . '</h3>';
                echo '<p>' . htmlspecialchars($row["tietoa"]) . '</p>';
                echo '<p><strong>€' . htmlspecialchars($row["hinta"]) . '</strong></p>';
                echo '</div>';
            }
        } else {
            echo "<p>Ei tuotteita saatavilla.</p>";
        }
        ?>
    </div>

    <footer>
        <p>Puh. +358 040 1234 567</p>
        <p>info@tigen.com</p>
        <p>Mannerheimintie 14-20, 00100 Helsinki</p>
        <p>Kauppakeskus Forum, 2. krs.</p>
    </footer>

    <!-- <script>
        const carousel = document.querySelector('.carousel');
        const items = document.querySelectorAll('.carousel-item');
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');
        let currentIndex = 0;
        let autoAdvanceInterval = null;
        const AUTO_ADVANCE_TIME = 8000; // 8 seconds

        function updateCarousel() {
            const itemWidth = 100;
            const translateX = currentIndex * itemWidth;
            carousel.style.transform = `translateX(-${translateX}%)`;
            
            // Update active states
            items.forEach((item, index) => {
                if (index === currentIndex) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }

        function resetAutoAdvance() {
            if (autoAdvanceInterval) {
                clearInterval(autoAdvanceInterval);
            }
            autoAdvanceInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % items.length;
                updateCarousel();
            }, AUTO_ADVANCE_TIME);
        }

        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            updateCarousel();
            resetAutoAdvance();
        });

        nextButton.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % items.length;
            updateCarousel();
            resetAutoAdvance();
        });

        // Initial setup
        updateCarousel();
        resetAutoAdvance();
    </script>
    <script>
        const bgImages = [
            'kuvat/kuva7.jpeg',
            'kuvat/kuva6.jpeg',
            'kuvat/kuva5.png',
            'kuvat/kuva4.jpg',
            'kuvat/kuva3.jpg',
            'kuvat/kuva2.jpg',
            'kuvat/kuva1.jpg'
        ];
        let bgIndex = 0; // -1 means "use CSS default"
        function setBackground(url) {
            document.body.style.backgroundImage = `url('${url}')`;
            document.documentElement.style.backgroundImage = `url('${url}')`;
        }
        function rotateBackgroundRandom() {
            let nextIndex;
            do {
                nextIndex = Math.floor(Math.random() * bgImages.length);
            } while (nextIndex === bgIndex && bgImages.length > 1);
            bgIndex = nextIndex;
            setBackground(bgImages[bgIndex]);
        }
        setInterval(rotateBackgroundRandom, 30000);


        const pdimage = [
            'kuvat/tuotteet/housut1m.jpeg',
            'kuvat/tuotteet/housut2m.jpeg',
            'kuvat/tuotteet/housut1n.jpg',
            'kuvat/tuotteet/housut2n.jpg',
            'kuvat/tuotteet/kengät1m.jpeg',
            'kuvat/tuotteet/kengät2m.jpeg',
            'kuvat/tuotteet/kengät1n.jpeg',
            'kuvat/tuotteet/kengät2n.jpg',
            'kuvat/tuotteet/paita2m.jpeg',
            'kuvat/tuotteet/paita1n.jpeg',
            'kuvat/tuotteet/paita2n.jpg',
            'kuvat/tuotteet/paita3m.jpeg',
        ]
        let pdIndex = 1;
    </script> -->
</body>
</html>