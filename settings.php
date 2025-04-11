<?php
session_start();
require_once 'includes/connect.php';
require_once 'auth.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = '';
$success = '';

// Fetch user settings
$stmt = $conn->prepare("SELECT * FROM user_settings WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$settings = $result->fetch_assoc() ?? [
    'email_notifications' => 1,
    'dark_mode' => 0,
    'language' => 'en'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_notifications = isset($_POST['email_notifications']) ? 1 : 0;
    $dark_mode = isset($_POST['dark_mode']) ? 1 : 0;
    $language = $_POST['language'];
    
    $stmt = $conn->prepare("INSERT INTO user_settings (user_id, email_notifications, dark_mode, language) 
                           VALUES (?, ?, ?, ?) 
                           ON DUPLICATE KEY UPDATE 
                           email_notifications = VALUES(email_notifications), 
                           dark_mode = VALUES(dark_mode), 
                           language = VALUES(language)");
    $stmt->bind_param("iiis", $_SESSION['user_id'], $email_notifications, $dark_mode, $language);
    
    if ($stmt->execute()) {
        $success = 'Settings updated successfully';
    } else {
        $error = 'Error updating settings';
    }
}

include 'includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-cog me-2"></i>Account Settings</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <?php if ($success): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="settings.php">
                        <h5 class="mb-3"><i class="fas fa-bell me-2"></i>Notification Settings</h5>
                        <div class="mb-4 ps-4">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications" <?= $settings['email_notifications'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="email_notifications">Email Notifications</label>
                            </div>
                        </div>
                        
                        <h5 class="mb-3"><i class="fas fa-palette me-2"></i>Appearance</h5>
                        <div class="mb-4 ps-4">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="dark_mode" name="dark_mode" <?= $settings['dark_mode'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="dark_mode">Dark Mode</label>
                            </div>
                            
                            <div class="mb-3">
                                <label for="language" class="form-label">Language</label>
                                <select class="form-select" id="language" name="language">
                                    <option value="en" <?= $settings['language'] === 'en' ? 'selected' : '' ?>>English</option>
                                    <option value="ar" <?= $settings['language'] === 'ar' ? 'selected' : '' ?>>العربية</option>
                                    <option value="fr" <?= $settings['language'] === 'fr' ? 'selected' : '' ?>>Français</option>
                                    <option value="es" <?= $settings['language'] === 'es' ? 'selected' : '' ?>>Español</option>
                                </select>
                            </div>
                        </div>
                        
                        <h5 class="mb-3"><i class="fas fa-shield-alt me-2"></i>Security</h5>
                        <div class="mb-4 ps-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-1">Two-Factor Authentication</h6>
                                    <small class="text-muted">Add an extra layer of security to your account</small>
                                </div>
                                <a href="two-factor.php" class="btn btn-sm btn-outline-primary">Set Up</a>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Connected Devices</h6>
                                    <small class="text-muted">Manage devices that have accessed your account</small>
                                </div>
                                <a href="devices.php" class="btn btn-sm btn-outline-primary">Manage</a>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>