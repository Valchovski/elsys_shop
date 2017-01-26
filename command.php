<?php
/**
* This is the class that contains the commands logic
*/
class Commands {
    var $command;
	private $conn;

	function __construct () {
        $this->command = $_GET['cmd'];

        $server = "localhost";
        $username = "root";
        $pw = "";
        $db = "elsys_shop";

        $this->conn = new mysqli($server, $username, $pw, $db);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        echo "Connected successfully";
	}
	
	/**
	 *	Adds an item to the fiscal receipt
	 */
	function addItem() {
		
		$item = $_POST['item'];
		$price = $_POST['price'];
		$qty = $_POST['quantity'];

		try {
			$sql = "INSERT INTO items (name, quantity, price) VALUES ('$item', $qty, $price)";
            if ($this->conn->query($sql) === TRUE) {
                header('Location: index.php?success=Item%20added%20successfully');
            } else {
                header('Location: index.php?error=Error%20in%20database');
            }
            die();
		} catch (Exception $e) {
			header('Location: index.php?error='.urlencode($e->getMessage())); die();
		}
	}

	function addToCart() {

        $item_id = $_POST['item_id'];
        $user_id = $_POST['user_id'];

        try {
            $sql = "INSERT INTO carts (user_id, item_id) VALUES ($user_id, $item_id)";
            if ($this->conn->query($sql) === TRUE) {
                header('Location: index.php?success=Item%20added%20to%20your%20cart!');
            } else {
                header('Location: index.php?error=Error%20in%20database');
            }
            die();
        } catch (Exception $e) {
            header('Location: index.php?error='.urlencode($e->getMessage())); die();
        }
    }

    function removeFromCart() {
        $item_id = $_POST['item_id'];
        $user_id = $_POST['user_id'];

        try {
            $sql = "DELETE FROM carts WHERE user_id = $user_id AND item_id = $item_id";
            if ($this->conn->query($sql) === TRUE) {
                header('Location: index.php?success=Item%20deleted%20from%20your%20cart!');
            } else {
                header('Location: index.php?error=Error%20in%20database');
            }
        } catch (Exception $e) {
            header('Location: index.php?error='.urlencode($e->getMessage())); die();
        }
    }

	/**
	 *	Call the command that is currently called from the user interface
	 */
	function run() {
		switch( $this->command ) {
			case 'addItem': $this->addItem(); break;
            case 'addToCart': $this->addToCart(); break;
            case 'removeFromCart': $this->removeFromCart(); break;
			default; header('Location: index.php?error=Unknown%20command'); die();
		}

		header('Location: index.php?success=Command%20executed%20successfully');
	}
}

$c = new Commands ();
$c->run();
?>