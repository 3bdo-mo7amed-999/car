<?php
session_start();
require_once 'includes/connect.php';
require_once 'auth.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <?php if (!empty($_SESSION['user_avatar'])): ?>
                    <img src="<?= htmlspecialchars($_SESSION['user_avatar']) ?>" alt="Profile" class="rounded-circle img-fluid" style="width: 150px;">
                    <?php else: ?>
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px;">
                        <i class="fas fa-user fa-4x text-secondary"></i>
                    </div>
                    <?php endif; ?>
                    <h5 class="my-3"><?= htmlspecialchars($_SESSION['user_name']) ?></h5>
                    <p class="text-muted mb-1">Member since <?= date('M Y', strtotime($_SESSION['created_at'] ?? 'now')) ?></p>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Quick Links</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="profile.php" class="text-decoration-none stretched-link">
                                <i class="fas fa-user me-2"></i>Profile
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="settings.php" class="text-decoration-none stretched-link">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="my-reviews.php" class="text-decoration-none stretched-link">
                                <i class="fas fa-comment me-2"></i>My Reviews
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="logout.php" class="text-decoration-none stretched-link text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-lg-9">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Welcome back, <?= htmlspecialchars($_SESSION['user_name']) ?>!
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Reviews Posted</h6>
                                            <h2 class="mb-0">12</h2>
                                        </div>
                                        <i class="fas fa-comment fa-3x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card bg-info text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Comments</h6>
                                            <h2 class="mb-0">34</h2>
                                        </div>
                                        <i class="fas fa-comments fa-3x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card bg-warning text-dark h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Likes Received</h6>
                                            <h2 class="mb-0">87</h2>
                                        </div>
                                        <i class="fas fa-thumbs-up fa-3x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-history me-2"></i>Recent Activity</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <i class="fas fa-comment me-2 text-primary"></i>
                                        You posted a review for BMW X5
                                    </div>
                                    <small class="text-muted">2 hours ago</small>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <i class="fas fa-thumbs-up me-2 text-success"></i>
                                        Someone liked your review on Tesla Model 3
                                    </div>
                                    <small class="text-muted">1 day ago</small>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <i class="fas fa-user-plus me-2 text-info"></i>
                                        You followed John Doe
                                    </div>
                                    <small class="text-muted">3 days ago</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>