<?php
include __DIR__ . '/config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Validate user_id exists
$sql_check_user = "SELECT * FROM users WHERE id='$user_id'";
$result_check_user = $conn->query($sql_check_user);

if ($result_check_user->num_rows == 0) {
    die("User does not exist.");
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['note_file'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $file_name = $_FILES['note_file']['name'];
    $file_tmp = $_FILES['note_file']['tmp_name'];
    $upload_dir = 'uploads/' . $file_name;

    if (move_uploaded_file($file_tmp, $upload_dir)) {
        $sql = "INSERT INTO notes (user_id, title, content, file_path) VALUES ('$user_id', '$title', '$content', '$upload_dir')";
        if ($conn->query($sql) === TRUE) {
            echo "Note uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload file.";
    }
}

// Handle note deletion
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete_note'])) {
    $note_id = $_GET['delete_note'];
    $sql = "DELETE FROM notes WHERE id='$note_id' AND user_id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Note deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle search
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $conn->real_escape_string($_GET['search']);
}

$sql = "SELECT * FROM notes WHERE title LIKE '%$search_query%' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 30px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .note-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .note-container h3 {
            margin-bottom: 5px;
        }

        .note-container p {
            margin-bottom: 10px;
        }

        .note-container a {
            color: #4CAF50;
            text-decoration: none;
            margin-right: 10px;
        }

        .note-container a:hover {
            text-decoration: underline;
        }

        .note-container p.user-info {
            font-size: 14px;
            color: #666;
        }

        .logout-button {
            display: block;
            margin: 0 auto 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to your dashboard</h1>
        <div class="logout-button">
            <a href="logout.php"><button>Logout</button></a>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" required><br>
            <label>Content:</label>
            <textarea name="content" rows="4" required></textarea><br>
            <label>Upload File:</label>
            <input type="file" name="note_file" required><br>
            <button type="submit">Upload Note</button>
        </form>

        <h2>All Notes</h2>
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search by title" value="<?php echo $search_query; ?>">
            <button type="submit">Search</button>
        </form>
        <?php while($note = $result->fetch_assoc()) { ?>
            <div class="note-container">
                <h3><?php echo $note['title']; ?></h3>
                <p><?php echo $note['content']; ?></p>
                <a href="<?php echo $note['file_path']; ?>" download>Download</a>
                <p class="user-info">Uploaded by: <?php echo getUserName($note['user_id']); ?></p>
                <?php if ($note['user_id'] == $user_id) { ?>
                    <a href="?delete_note=<?php echo $note['id']; ?>">Delete</a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>
