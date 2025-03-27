<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentUploadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HelpDeskController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShipRocketController;
use App\Http\Controllers\StudentClassroomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/all-categories', [CategoryController::class, 'getAllCategories']);
Route::get('/show-category/{id}', [CategoryController::class, 'show']);
Route::get('products', [ProductController::class, 'index']);
Route::get('/products/view/{id}', [ProductController::class, 'productView']);

Route::get('/categories/{id}', [CategoryController::class, 'getCategoriesByParent']);

Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/plans/student', [PlanController::class, 'showPlanForStudent']);

    Route::put('/update-token', [NotificationController::class, 'updateDeviceToken']);
    Route::post('/send-notification', [NotificationController::class, 'sendNotification']);

    Route::get('/manage-coupon', [CouponController::class,'manageCoupon']);
    Route::get('/parent-categories', [CategoryController::class, 'getParentCategories']);

    //  (accessible to all authenticated users)
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::apiResource('help-desks', HelpDeskController::class);

    Route::apiResource('wishlist', WishlistController::class);
    Route::apiResource('address', AddressController::class);
    Route::apiResource('orders', OrderController::class);
    Route::post('add-to-cart', [OrderController::class,'addToCart']);
    Route::delete('remove-from-cart/{id}', [OrderController::class,'removeFromCart']);
    Route::get('view-cart', [OrderController::class,'viewCart']);
    Route::delete('/orders/{id}/cancel', [OrderController::class, 'cancelOrder']);

    Route::get('/faqs/active', [FaqController::class, 'onlyShowActiveFAQs']);

    Route::apiResource('reviews', ReviewController::class);
    Route::post('/create-payment', [PaymentController::class, 'createPayment']);
    Route::post('/verify-payment', [PaymentController::class, 'callback']);
    // Route::apiResource('products', ProductController::class);

    Route::post('/send-message', [MessageController::class, 'sendMessage']);
    Route::get('/get-messages', [MessageController::class, 'getMessages']);
    Route::get('/get-conversation/{receiverId}', [MessageController::class, 'getConversation']);
    Route::put('/mark-as-read/{messageId}', [MessageController::class, 'markAsRead']);
    Route::delete('/delete-message/{messageId}', [MessageController::class, 'deleteMessage']);
    Route::get('/subject-classes/{id}', [ClassroomController::class, 'subjectClasses'])->name('subject.classes');
    Route::get('/classroom/{classroom_id}/announcements', [AnnouncementController::class, 'getAnnouncementsByClass'])->name('announcement.manage');

    // Admin routes
    Route::middleware([RoleMiddleware::class . ':admin'])->get('/admin-dashboard', function () {
        return response()->json(['message' => 'admin API is working!']);
    });
    Route::middleware([RoleMiddleware::class . ':instructor'])->get('/instructor-dashboard', function () {
        return response()->json(['message' => 'instructor API is working!']);
    });
    Route::middleware([RoleMiddleware::class . ':seller'])->get('/seller-dashboard', function () {
        return response()->json(['message' => 'seller API is working!']);
    });
    Route::middleware([RoleMiddleware::class . ':student'])->get('/student-dashboard', function () {
        return response()->json(['message' => 'student API is working!']);
    });

    //Admin
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('categories/{id}', [CategoryController::class, 'update']);
        Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
        Route::post('/admin/products', [ProductController::class, 'store'])->name('books.store');
        Route::put('/admin/products/{id}', [ProductController::class, 'update']); // Update product
        Route::delete('/admin/products/{product}', [ProductController::class, 'destroy']); // Delete product
        Route::apiResource('coupons', CouponController::class);
        Route::apiResource('subject', SubjectController::class);
        Route::post('/admin-student', [StudentController::class, 'adminStore'])->name('admin.student.store');
        Route::post('/admin-instructor', [InstructorController::class, 'adminStore'])->name('admin.instructor.store');
        Route::put('/update-status/{id}', [AuthController::class, 'updateStatus'])->name('status.update');
        Route::post('/admin-vendor', [VendorController::class, 'adminStore'])->name('admin.vendor.store');
        Route::apiResource('plans', PlanController::class);
        Route::apiResource('faqs', FaqController::class);
    });

    Route::middleware([RoleMiddleware::class . ':student'])->group(function () {
        Route::apiResource('student', StudentController::class);
        Route::apiResource('student-classroom', StudentClassroomController::class);
        Route::get('all-classroom', [ClassroomController::class,'allClassroom']);
        Route::get('grade/{uploadId}', [GradeController::class,'getGrades']);
        Route::post('/student/assignments/upload', [AssignmentUploadController::class, 'store']);
        Route::post('/student-profile', [StudentController::class, 'updateProfile']);
        Route::get('/student-profile', [StudentController::class, 'showProfile']);
    });

    //Seller
    Route::middleware([RoleMiddleware::class . ':seller'])->group(function () {
        Route::apiResource('vendors', VendorController::class);
        Route::post('/vendor/products', [ProductController::class, 'store']);
        Route::get('/vendor/categories', [VendorController::class, 'getVendorCategories']);
        Route::get('/get/vendor/products', [VendorController::class, 'getVendorProducts']);
        Route::put('/vendor/products/{id}', [ProductController::class, 'update']); // Update product
        Route::delete('/vendor/products/{product}', [ProductController::class, 'destroy']); // Delete product
        Route::get('/vendor/dashboard', [VendorController::class, 'getVendorDashboard']);
        Route::post('/vendor-store', [VendorController::class, 'store']);
        Route::get('/vendor/review/{product_id}', [ReviewController::class, 'vendorIndex']);
        Route::get('/vendor/all-orders', [OrderController::class, 'vendorOrderIndex']);
        Route::get('/vendor/review-image/{product_id}', [ReviewController::class, 'allReviewImage']);
        Route::get('/vendor/profile', [VendorController::class, 'editSeller']);
        Route::post('/vendor/profile', [VendorController::class, 'updateSeller']);
    });
     Route::middleware([RoleMiddleware::class . ':instructor'])->group(function () {
        // Route::apiResource('/instructor', [InstructorController::class]);
        Route::apiResource('instructor', InstructorController::class);
        Route::apiResource('classroom', ClassroomController::class);
        Route::post('/class-chapter/{classroom_id}', [ClassroomController::class, 'createNewChapter'])->name('class.store');
        Route::get('/manage-classes', [ClassroomController::class, 'manageClasses'])->name('manage.class');
        Route::post('/announcement', [AnnouncementController::class, 'createAnnouncement'])->name('annocment.store');
        // Route::post('/assignments', [AnnouncementController::class, 'store']);
        Route::get('/assignments', [AnnouncementController::class, 'getInstructorAssignments']);
        Route::get('/assignments/{assignmentId}/submissions', [AnnouncementController::class, 'getSubmissions']);
        Route::get('/assignments/{assignmentId}/submission', [AssignmentUploadController::class, 'viewSubmissions']);
        Route::post('/instructor/grade/{uploadId}', [GradeController::class, 'storeGrades']);
        Route::post('/instructor-profile', [InstructorController::class, 'updateProfile']);
        Route::get('/instructor-profile', [InstructorController::class, 'showProfile']);
        Route::get('/classroom/{id}/chapters', [ClassroomController::class, 'getClassChapters']);

    });
});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/categories/{id}/products', [ProductController::class, 'getproductByCategories']);
Route::get('/products/filter', [ProductController::class, 'filterProducts']);

// shiprocket apis not tested

// Route::post('/create-order', [ShiprocketController::class, 'createOrder']);
// Route::get('/track-order/{order_id}', [ShipRocketController::class, 'trackOrder']);

Route::post('/shiprocket/pickup-location', [ShiprocketController::class, 'addPickupLocation']);
Route::post('/shiprocket/create-order', [ShiprocketController::class, 'createOrder']);
Route::get('/shiprocket/track/{awb}', [ShiprocketController::class, 'trackOrder']);

Route::post('/shiprocket/webhook', [ShiprocketController::class, 'handleWebhook']);

// zoom meeting intergration

Route::get('/zoom/redirect', [ZoomController::class, 'redirectToZoom']);
Route::get('/zoom/callback', [ZoomController::class, 'handleZoomCallback']);

// Zoom Meeting Endpoints (require prior OAuth authentication)
// Route::post('/zoom/meetings', [ZoomController::class, 'createMeeting']);
// Route::get('/zoom/meetings', [ZoomController::class, 'listMeetings']);
// Route::get('/zoom/meetings/upcoming', [ZoomController::class, 'upcomingMeetings']);
// Route::get('/zoom/meetings/{meetingId}', [ZoomController::class, 'shareMeeting']);

Route::get('/zoom/create-meeting', [ZoomController::class, 'createMeeting']);



