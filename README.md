# Webhook-Based Auto Shutdown
 This project allows you to automatically shut down a Linux system when a specific webhook is triggered.
 
## Files Included

- `code.sh`: A shell script that shuts down the system when executed.
- `webhook.php`: A PHP script that listens for the webhook, logs the event, and triggers the shutdown script.
- `off`: A custom script that sends an HTTP GET request to the webhook URL to trigger the shutdown.

## Setup Instructions

1. **Prepare the Server**  
   Ensure you have a Linux system with Apache installed.

2. **Place Files**  
   Place `code.sh` and `webhook.php` in your web server's directory (e.g., `/var/www/html`).

3. **Make the Script Executable**  
   Run the following command to make `code.sh` executable:
   ```bash
   sudo chmod +x /var/www/html/code.sh
4. **Configure sudo Permissions**
   Edit the sudoers file to allow the script to run without a password prompt:
   ```bash
   sudo visudo
   ```
   Add this line (replace your_username with your actual username)
   
   `your_username ALL=(ALL) NOPASSWD: /bin/bash /var/www/html/code.sh`
5. **Set Up the off Command**
   Place the off script in `/usr/local/bin/` and make it executable:
   ```bash 
   sudo chmod +x /usr/local/bin/off
   ```
6. **Trigger the Webhook**
Access the `webhook.php` endpoint via a URL (eg. `http://your-server-ip/webhook.php`) to trigger the shutdown.

## How It Works

1. The PHP script (`webhook.php`) listens for incoming HTTP GET requests.
2. When triggered, it logs the time of the request in `/var/log/apache2/webhook_result.log`.
3. The script then calls `code.sh`, which shuts down the system immediately.
4. The `off` command is a shortcut to send an HTTP GET request to `webhook.php` and trigger the shutdown.

## Sending the Webhook

You can send an HTTP GET request in the following ways:
### Using the `off` Command
Run the following command to trigger the shutdown:

```bash
off
```
### Example HTTP GET Request
Use `curl` to manually send the webhook:

```bash
curl http://192.168.247.1/webhook.php
```
## Security Considerations

To prevent unauthorized shutdowns, restrict access to the webhook using secure methods like IP whitelisting or adding an API key. Ensure your web server is securely configured.

**Note:** Security features will be added soon.

