<?php
include 'components/connect.php';

session_start();
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

$stmt = $conn->prepare("SELECT coins FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user_coins = $stmt->fetchColumn();

// Process purchase
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $item_price = $_POST['item_price'];

    if ($user_coins >= $item_price) {
        // Deduct the item price from the user's coin balance
        $new_coin_balance = $user_coins - $item_price;
        $stmt = $conn->prepare("UPDATE users SET coins = ? WHERE id = ?");
        $stmt->execute([$new_coin_balance, $user_id]);

        // Send the new balance back as a response
        echo json_encode(['success' => true, 'new_balance' => $new_coin_balance]);
        exit;
    } else {
        // Return an error message if the user doesn't have enough coins
        echo json_encode(['success' => false, 'message' => 'Not enough coins! Please get more coins to make this purchase.']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educa Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ffecd2, #fcb69f);
            overflow: hidden; /* Prevent items from scrolling out of view */
        }
        .store-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .store-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .coin-balance {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }
        .store-items {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px; /* Gap between items */
            padding: 20px; /* Padding inside the container */
        }
        .store-item {
            width: 200px;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
            background-color: #f9f9f9;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s; /* Smooth animation for hovering */
        }
        .store-item img {
            max-width: 100%;
            height: auto;
        }
        .store-item h3 {
            margin-top: 10px;
        }
        .store-item p {
            margin-top: 5px;
        }
        .buy-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }
        /* Animation for hovering over items */
        .store-item:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="store-container">
        <div class="store-header">
            <h1>Educa Store</h1>
        </div>
        <div class="coin-balance" id="coin-balance">
            Your coin balance: <?php echo $user_coins; ?>
        </div>
        <div class="store-items">
            <?php
            // Fetch merchandise items from the database
            $stmt = $conn->prepare("SELECT * FROM merchandise");
            $stmt->execute();
            $merchandise = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($merchandise as $item) {
                echo '<div class="store-item">';
                echo '<img src="' . $item['image_url'] . '" alt="' . $item['name'] . '">';
                echo '<h3>' . $item['name'] . '</h3>';
                echo '<p class="store-item-price">Price: ' . $item['price'] . ' coins</p>';
                echo '<form class="purchase-form">';
                echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
                echo '<input type="hidden" name="item_price" value="' . $item['price'] . '">';
                echo '<button type="button" class="buy-button">Buy</button>';
                echo '</form>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buyButtons = document.querySelectorAll('.buy-button');
            buyButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    purchaseItem(this);
                });
            });
        });

        function purchaseItem(button) {
            var form = button.closest('.store-item').querySelector('.purchase-form');
            var formData = new FormData(form);
            var itemName = button.closest('.store-item').querySelector('h3').textContent;
            var itemPrice = button.closest('.store-item').querySelector('.store-item-price').textContent;

            if (confirm('Are you sure you want to buy ' + itemName + ' for ' + itemPrice + ' coins?')) {
                fetch('store.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('coin-balance').textContent = 'Your coin balance: ' + data.new_balance;
                        alert('Purchase successful! Your new coin balance is ' + data.new_balance + '.');
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</body>
</html>
