<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\CustomVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class UserRegistrationAndResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test new user registration sends CustomVerifyEmail notification.
     */
    public function test_user_registration_sends_verification_notification(): void
    {
        Notification::fake();

        $userData = [
            'name' => 'أحمد علي',
            'username' => 'ahmedali',
            'email' => 'ahmed@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'phone' => '0501234567',
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertRedirect(route('verification.notice'));

        $user = User::where('email', 'ahmed@example.com')->first();
        $this->assertNotNull($user);

        Notification::assertSentTo($user, CustomVerifyEmail::class);
    }

    /**
     * Test rendered email template for registration verification.
     */
    public function test_custom_verify_email_notification_content(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $notification = new CustomVerifyEmail();
        $mailMessage = $notification->toMail($user);

        $this->assertEquals('تأكيد عنوان البريد الإلكتروني', $mailMessage->subject);
        $this->assertEquals('mails.verify-email', $mailMessage->view);
        $this->assertArrayHasKey('url', $mailMessage->viewData);
        $this->assertStringContainsString('/email/verify/', $mailMessage->viewData['url']);
    }

    /**
     * Test requesting password reset link sends ResetPasswordNotification.
     */
    public function test_forgot_password_sends_reset_notification(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'user@example.com',
        ]);

        $response = $this->post(route('password.email'), [
            'email' => 'user@example.com',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        Notification::assertSentTo($user, ResetPasswordNotification::class, function ($notification) {
            return !empty($notification->token);
        });
    }

    /**
     * Test rendered email template for password reset.
     */
    public function test_reset_password_notification_content(): void
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
        ]);

        $token = Password::createToken($user);

        $notification = new ResetPasswordNotification($token);
        $mailMessage = $notification->toMail($user);

        $this->assertEquals('إعادة تعيين كلمة المرور', $mailMessage->subject);
        $this->assertEquals('mails.reset-password', $mailMessage->view);
        $this->assertArrayHasKey('resetUrl', $mailMessage->viewData);
        $this->assertStringContainsString('/reset-password/', $mailMessage->viewData['resetUrl']);
        $this->assertStringContainsString($token, $mailMessage->viewData['resetUrl']);
    }

    /**
     * Test complete password reset process with token.
     */
    public function test_user_can_reset_password_with_token(): void
    {
        $user = User::factory()->create([
            'email' => 'testreset@example.com',
            'password' => Hash::make('old-password'),
        ]);

        $token = Password::createToken($user);

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => 'testreset@example.com',
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('login'));

        $this->assertTrue(Hash::check('NewPassword123!', $user->fresh()->password));
    }
}
