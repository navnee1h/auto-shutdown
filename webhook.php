<?php
date_default_timezone_set('Asia/Kolkata');
$webhook_time = date('Y-m-d h:i:s A');

// Log trigger time
$log_result = file_put_contents('/var/log/apache2/webhook_result.log', "Webhook triggered at $webhook_time\n", FILE_APPEND);

// failed
if ($log_result === false) {
    echo "Failed to log the time! ";
} else {
    echo "Log written successfully!\n";
}

// Run the script
$output = shell_exec('sudo /bin/bash /var/www/html/code.sh');
echo "Script executed successfully!";
?>
