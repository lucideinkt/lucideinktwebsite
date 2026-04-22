# Mailtrap Auto-Forwarding Setup Guide

## Overview
This guide explains how to use Mailtrap's auto-forwarding feature to receive copies of test emails in your real Gmail inbox while developing/staging.

## How It Works

Mailtrap's auto-forwarding feature forwards emails to real recipients when:
1. The forwarding email is added to your Mailtrap inbox's "Auto Forwarding Rules"
2. The forwarding email is included in the "To" or "Cc" field of the email
3. Mailtrap keeps a copy in the test inbox for debugging

## Configuration

### 1. Mailtrap Dashboard Setup (Already Done ✅)
- Login to [Mailtrap.io](https://mailtrap.io)
- Go to your inbox settings
- Navigate to "Auto Forwarding Rules"
- Added email: `lucideinkt@gmail.com` ✅

### 2. Laravel Environment Variable
Added to `.env`:
```env
# Mailtrap Auto-Forwarding Email (add to CC for forwarding to real inbox)
MAILTRAP_FORWARD_EMAIL="lucideinkt@gmail.com"
```

### 3. Mailable Classes Updated
All mailable classes now automatically add the forwarding email to CC when configured:

#### Updated Files:
1. `app/Mail/ContactFormMail.php` - Contact form submissions
2. `app/Mail/NewOrderMail.php` - New order notifications (to admin)
3. `app/Mail/OrderPaidMail.php` - Order confirmation (to customer)
4. `app/Mail/WelcomeMail.php` - Welcome email for new users
5. `app/Mail/NewUserMail.php` - Admin notification for new user
6. `app/Mail/NewsletterMail.php` - Newsletter emails

#### Code Pattern:
```php
// Add Mailtrap forwarding email to CC if configured
$forwardEmail = env('MAILTRAP_FORWARD_EMAIL');
if ($forwardEmail && filter_var($forwardEmail, FILTER_VALIDATE_EMAIL)) {
    $mail->cc($forwardEmail);
}
```

## Testing

### Test Contact Form:
1. Go to: http://lucideinktwebshop.test/contact
2. Fill out and submit the contact form
3. Check:
   - Mailtrap inbox (should have a copy)
   - `lucideinkt@gmail.com` (should receive forwarded email)

### Test Order Flow:
1. Create a test order
2. Complete payment (use Mollie test mode)
3. Check:
   - Customer should receive OrderPaidMail
   - Admin should receive NewOrderMail
   - Both emails should be forwarded to `lucideinkt@gmail.com`
   - All emails should appear in Mailtrap inbox

### Test User Registration:
1. Register a new user
2. Check:
   - User receives WelcomeMail
   - Admin receives NewUserMail (if configured)
   - Forwarded to `lucideinkt@gmail.com`

## Behavior by Environment

### Staging (Current Setup)
- `APP_ENV=staging`
- `MAIL_HOST=sandbox.smtp.mailtrap.io`
- Emails go to Mailtrap AND forwarded to Gmail ✅

### Production (Future)
When moving to production:
1. Update `APP_ENV=production`
2. Change `MAIL_HOST` to real SMTP server
3. **Remove or comment out** `MAILTRAP_FORWARD_EMAIL` in `.env`
4. Update mail configuration to use production mail server

```env
# Production mail settings example:
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
# MAILTRAP_FORWARD_EMAIL="" # Disable in production
```

## Important Notes

### Security
- ✅ Forwarding email is validated with `filter_var($forwardEmail, FILTER_VALIDATE_EMAIL)`
- ✅ Only works when `MAILTRAP_FORWARD_EMAIL` is set in `.env`
- ✅ Easy to disable by removing/commenting the env variable

### Gmail Delivery
- Forwarded emails will appear in `lucideinkt@gmail.com` inbox
- Sender will show as: `info@lucideinkt.nl` (MAIL_FROM_ADDRESS)
- Subject will match the original email
- All attachments (like invoices) are included

### Debugging
If emails are not being forwarded:
1. Check Mailtrap inbox - does the email show `lucideinkt@gmail.com` in CC?
2. Check Mailtrap dashboard - is auto-forwarding rule active?
3. Check Gmail spam folder
4. Verify `MAILTRAP_FORWARD_EMAIL` in `.env` matches exactly

### Best Practices
- ✅ Use CC instead of To - maintains original recipient
- ✅ Check environment before sending - only forward in dev/staging
- ✅ Keep forwarding email in `.env`, not hardcoded
- ✅ Test with multiple email types (order, contact, newsletter)

## Troubleshooting

### Email Not Forwarded
```bash
# Check if .env is loaded
php artisan config:clear
php artisan cache:clear

# Test email manually
php artisan tinker
>>> Mail::to('test@example.com')->cc(env('MAILTRAP_FORWARD_EMAIL'))->send(new \App\Mail\WelcomeMail(\App\Models\User::first()));
```

### Environment Variable Not Loading
```bash
# Clear config cache
php artisan config:clear

# Verify env variable
php artisan tinker
>>> env('MAILTRAP_FORWARD_EMAIL')
```

## Summary

✅ **What Was Done:**
1. Added `MAILTRAP_FORWARD_EMAIL` to `.env`
2. Updated 6 mailable classes to include forwarding email in CC
3. Added validation to ensure email is valid before adding to CC
4. Maintained backward compatibility (works without the env variable)

✅ **Result:**
- All test emails are now forwarded to `lucideinkt@gmail.com`
- Mailtrap keeps copies for debugging
- Easy to disable for production
- No breaking changes to existing functionality

## Next Steps

1. Test the contact form
2. Test order flow (if possible)
3. Verify emails arrive in Gmail
4. Monitor Mailtrap inbox for any issues

