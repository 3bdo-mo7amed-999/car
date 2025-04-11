<?php
session_start();
require_once 'includes/connect.php';
require_once 'auth.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// جلب بيانات المستخدم
$stmt = $conn->prepare("SELECT id, name, email, avatar, bio FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $bio = trim($_POST['bio'] ?? '');

    // معالجة رفع الصورة
    if (!empty($_FILES['avatar']['name'])) {
        $target_dir = "uploads/avatars/";
        
        // إنشاء المجلد إذا لم يكن موجوداً
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        $new_filename = 'user_' . $_SESSION['user_id'] . '.' . $file_extension;
        $target_path = $target_dir . $new_filename;

        // التحقق من أن الملف صورة
        $check = getimagesize($_FILES['avatar']['tmp_name']);
        if ($check === false) {
            $error = 'الملف المرفوع ليس صورة';
        } 
        // التحقق من حجم الصورة (9MB كحد أقصى)
        elseif ($_FILES['avatar']['size'] > 9000000) {
            $error = 'حجم الصورة كبير جداً (الحد الأقصى 2MB)';
        } 
        // التحقق من امتداد الصورة
        elseif (!in_array($file_extension, ['jpg', 'jpeg', 'png'])) {
            $error = 'امتداد الصورة غير مسموح به (يجب أن يكون JPG, JPEG أو PNG)';
        } 
        // محاولة رفع الصورة
        elseif (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_path)) {
            // حذف الصورة القديمة إذا كانت موجودة
            if (!empty($user['avatar']) && file_exists($user['avatar'])) {
                unlink($user['avatar']);
            }
            
            // تحديث مسار الصورة في قاعدة البيانات
            $update_stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE id = ?");
            $update_stmt->bind_param("si", $target_path, $_SESSION['user_id']);
            if ($update_stmt->execute()) {
                $_SESSION['user_avatar'] = $target_path;
                $success = 'تم تحديث الصورة بنجاح';
            } else {
                $error = 'حدث خطأ أثناء تحديث الصورة في قاعدة البيانات';
                unlink($target_path); // حذف الصورة إذا فشل تحديث قاعدة البيانات
            }
        } else {
            $error = 'حدث خطأ أثناء رفع الصورة';
        }
    }

    // تحديث البيانات الأخرى إذا لم يكن هناك أخطاء
    if (empty($error)) {
        $stmt = $conn->prepare("UPDATE users SET name = ?, bio = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $bio, $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            $_SESSION['user_name'] = $name;
            $success = empty($success) ? 'تم تحديث الملف الشخصي بنجاح' : $success;
        } else {
            $error = 'حدث خطأ أثناء تحديث البيانات';
        }
    }
}

include 'includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>تعديل الملف الشخصي</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <?php if ($success): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="profile.php" enctype="multipart/form-data">
                        <div class="text-center mb-4">
                            <?php if (!empty($user['avatar'])): ?>
                                <img src="<?= htmlspecialchars($user['avatar']) ?>" 
                                     class="rounded-circle" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" 
                                     style="width: 150px; height: 150px;">
                                    <i class="fas fa-user fa-3x text-secondary"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div class="mt-3">
                                <label class="btn btn-primary btn-sm">
                                    <i class="fas fa-camera me-2"></i> تغيير الصورة
                                    <input type="file" name="avatar" class="d-none" accept="image/jpeg, image/png">
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم الكامل</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" 
                                   value="<?= htmlspecialchars($user['email'] ?? '') ?>" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="bio" class="form-label">نبذة عنك</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>حفظ التغييرات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>