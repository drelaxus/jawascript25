<?php

// A more complex PHP script example

// --- Configuration ---
$pageTitle = "User List";
$users = [
    ["id" => 1, "name" => "Alice", "email" => "alice@example.com"],
    ["id" => 2, "name" => "Bob", "email" => "bob@example.com"],
    ["id" => 3, "name" => "Charlie", "email" => "charlie@example.com"],
    ["id" => 4, "name" => "David", "email" => "david@example.com"],
];

// --- Functions ---

/**
 * Renders the header for the HTML page.
 * @param string $title The title of the page.
 */
function render_header(string $title): void {
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; color: #333; }
        .container { max-width: 800px; margin: 2rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #4a4a4a; }
        table { width: 100%; border-collapse: collapse; margin-top: 1.5rem; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        tbody tr:hover { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{$title}</h1>
HTML;
}

/**
 * Renders the footer for the HTML page.
 */
function render_footer(): void {
    $year = date('Y');
    echo <<<HTML
        <footer>
            <p style="text-align: center; margin-top: 2rem; color: #888;">&copy; {$year} My PHP App</p>
        </footer>
    </div>
</body>
</html>
HTML;
}

/**
 * Displays a list of users in a table.
 * @param array $users The list of users to display.
 */
function display_users(array $users): void {
    if (empty($users)) {
        echo "<p>No users found.</p>";
        return;
    }

    echo "<table>";
    echo "<thead><tr><th>ID</th><th>Name</th><th>Email</th></tr></thead>";
    echo "<tbody>";

    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user['id']) . "</td>";
        echo "<td>" . htmlspecialchars($user['name']) . "</td>";
        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

// --- Main Execution ---

render_header($pageTitle);
display_users($users);
render_footer();

?>
