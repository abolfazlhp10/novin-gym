# Novin Gym API Documentation

## Overview

This document provides comprehensive documentation for the Novin Gym API, a Laravel-based application for gym management with user authentication and role-based access control.

## Table of Contents

1. [API Overview](#api-overview)
2. [Authentication](#authentication)
3. [Endpoints](#endpoints)
4. [Data Models](#data-models)
5. [Error Handling](#error-handling)
6. [Testing](#testing)
7. [Configuration](#configuration)
8. [Development Setup](#development-setup)

## API Overview

The Novin Gym API is built with Laravel and provides the following features:

- **User Registration**: Register new coach users with gym information
- **OTP Authentication**: Secure login using one-time passwords sent via SMS
- **Role-Based Access**: Support for Coach and Admin roles using Spatie Laravel Permission
- **Gym Management**: Associate users with gym information
- **Sanctum Authentication**: Token-based authentication for API access

### Base URL
- **Development**: `http://localhost:8000/api`
- **Production**: `https://api.novingym.com/api`

## Authentication

The API uses Laravel Sanctum for authentication. The authentication flow is:

1. **Registration**: User registers with phone number and gym information
2. **OTP Request**: User requests OTP via SMS
3. **Login**: User authenticates with phone number and OTP
4. **Token Generation**: Sanctum token is generated and returned
5. **API Access**: Token is used for subsequent API requests

### Token Usage

Include the token in the Authorization header:
```
Authorization: Bearer {token}
```

The token is also automatically set as an HTTP-only cookie for enhanced security.

## Endpoints

### 1. User Registration

**POST** `/register`

Register a new coach user with gym information.

**Request Body:**
```json
{
  "first_name": "علی",
  "last_name": "احمدی", 
  "phone_number": "09123456789",
  "gym_name": "باشگاه ورزشی نوین"
}
```

**Validation Rules:**
- `first_name`: Required, string, 5-255 characters
- `last_name`: Required, string, 5-255 characters  
- `phone_number`: Required, Iranian mobile format (09xxxxxxxxx), unique
- `gym_name`: Required, string, 3-255 characters

**Response (201):**
```json
{
  "message": "ثبت نام با موفقیت انجام شد",
  "data": {
    "id": 1,
    "first_name": "علی",
    "last_name": "احمدی",
    "phone_number": "09123456789",
    "created_at": "2025-07-17T11:30:00.000000Z",
    "updated_at": "2025-07-17T11:30:00.000000Z",
    "gym": {
      "id": 1,
      "name": "باشگاه ورزشی نوین",
      "user_id": 1,
      "created_at": "2025-07-17T11:30:00.000000Z",
      "updated_at": "2025-07-17T11:30:00.000000Z"
    }
  }
}
```

### 2. Send OTP

**POST** `/send-otp`

Send a one-time password to the specified phone number.

**Request Body:**
```json
{
  "phone_number": "09123456789"
}
```

**Validation Rules:**
- `phone_number`: Required, Iranian mobile format, must exist in users table

**Response (200):**
```json
{
  "message": "رمز یکبار مصرف با موفقیت ارسال شد",
  "data": []
}
```

**Notes:**
- OTP is valid for 2 minutes
- In testing environment, OTP is always `12345` (configurable)
- OTP is automatically deleted after successful login

### 3. User Login

**POST** `/login`

Authenticate user using phone number and OTP.

**Request Body:**
```json
{
  "phone_number": "09123456789",
  "otp_code": 12345
}
```

**Validation Rules:**
- `phone_number`: Required, Iranian mobile format, must exist
- `otp_code`: Required, 5-digit integer (10000-99999)

**Response (200):**
```json
{
  "message": "ورود با موفقیت انجام شد",
  "data": {
    "id": 1,
    "first_name": "علی",
    "last_name": "احمدی",
    "phone_number": "09123456789",
    "created_at": "2025-07-17T11:30:00.000000Z",
    "updated_at": "2025-07-17T11:30:00.000000Z",
    "token": "1|abcdef1234567890abcdef1234567890abcdef1234567890"
  }
}
```

**Headers:**
```
Set-Cookie: auth_token=1|abcdef1234567890abcdef1234567890abcdef1234567890; HttpOnly; Secure; SameSite=Strict
```

## Data Models

### User Model
```php
{
  "id": "integer",
  "first_name": "string",
  "last_name": "string", 
  "phone_number": "string",
  "created_at": "datetime",
  "updated_at": "datetime",
  "gym": "Gym object"
}
```

### Gym Model
```php
{
  "id": "integer",
  "name": "string",
  "user_id": "integer",
  "created_at": "datetime",
  "updated_at": "datetime"
}
```

### OTP Model
```php
{
  "id": "integer",
  "phone_number": "string",
  "otp_code": "integer",
  "expiration_time": "datetime"
}
```

## Error Handling

The API follows standard HTTP status codes and returns consistent error responses:

### Common Status Codes
- **200**: Success
- **201**: Created (registration)
- **422**: Validation Error
- **500**: Internal Server Error

### Error Response Format
```json
{
  "message": "Error description"
}
```

### Validation Error Format
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "field_name": [
      "Error message"
    ]
  }
}
```

### Common Error Messages
- `"ثبت نام با موفقیت انجام شد"` - Registration successful
- `"ارور در ثبت نام کاربر !"` - Registration error
- `"رمز یکبار مصرف با موفقیت ارسال شد"` - OTP sent successfully
- `"ارور در ارسال رمز یکبار مصرف"` - OTP sending error
- `"کد یکبار مصرف نامعتبر است"` - Invalid OTP
- `"ورود با موفقیت انجام شد"` - Login successful

## Testing

### Testing Environment
In testing environment, the SMS service is mocked and the OTP code is always `12345` (configurable via `TESTING_SMS_OTP` environment variable).

### Test Data
```json
{
  "phone_number": "09123456789",
  "otp_code": 12345
}
```

### API Testing Tools
- **Swagger UI**: Use the `swagger.yaml` file with Swagger UI
- **Postman**: Import the endpoints using the provided examples
- **cURL**: Use the examples below

### cURL Examples

**Registration:**
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "علی",
    "last_name": "احمدی",
    "phone_number": "09123456789",
    "gym_name": "باشگاه ورزشی نوین"
  }'
```

**Send OTP:**
```bash
curl -X POST http://localhost:8000/api/send-otp \
  -H "Content-Type: application/json" \
  -d '{
    "phone_number": "09123456789"
  }'
```

**Login:**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "phone_number": "09123456789",
    "otp_code": 12345
  }'
```

## Configuration

### Environment Variables
```env
# SMS Configuration
SMS_DRIVER=testing|farazsms
TESTING_SMS_OTP=12345

# FarazSMS Configuration (Production)
FARAZSMS_BASEURL=https://ippanel.com/patterns/pattern
FARAZSMS_USERNAME=your_username
FARAZSMS_PASSWORD=your_password
FARAZSMS_FROM=+3000505
FARAZSMS_PATTERN_CODE=your_pattern_code
```

### SMS Service Configuration
The API supports multiple SMS providers:
- **Testing**: Mock service for development
- **FarazSMS**: Production SMS service for Iran

### Role Configuration
Available roles:
- `coach`: Default role for registered users
- `admin`: Administrative role

## Development Setup

### Prerequisites
- PHP 8.1+
- Laravel 10+
- MySQL/PostgreSQL
- Composer

### Installation
1. Clone the repository
2. Install dependencies: `composer install`
3. Copy environment file: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Configure database in `.env`
6. Run migrations: `php artisan migrate`
7. Seed roles: `php artisan db:seed --class=RoleSeeder`

### Database Migrations
The application includes migrations for:
- Users table
- Gyms table
- OTPs table
- Roles and permissions (Spatie)

### Running the Application
```bash
php artisan serve
```

The API will be available at `http://localhost:8000/api`

## Security Considerations

1. **Phone Number Validation**: Strict Iranian mobile number format validation
2. **OTP Expiration**: OTP codes expire after 2 minutes
3. **Token Security**: Sanctum tokens with HTTP-only cookies
4. **Input Validation**: Comprehensive validation rules for all inputs
5. **SQL Injection Protection**: Laravel Eloquent ORM protection
6. **XSS Protection**: Laravel built-in protection

## Rate Limiting

Consider implementing rate limiting for:
- OTP requests (prevent abuse)
- Login attempts (prevent brute force)
- Registration requests (prevent spam)

## Monitoring and Logging

The application logs:
- Critical errors during registration
- SMS service failures
- Authentication attempts
- OTP generation and validation

## Support

For technical support or questions about the API:
- Email: support@novingym.com
- Documentation: This file and the Swagger specification
- Issues: Use the project's issue tracker

---

**Last Updated**: July 17, 2025
**Version**: 1.0.0 