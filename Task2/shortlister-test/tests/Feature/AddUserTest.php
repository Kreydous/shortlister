<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

test('user can be added successfully', function () {
    $response = $this->post(route('user.add'), [
        'full_name'     => 'John Doe',
        'email'         => 'john@example.com',
        'phone_number'  => '+12345678901', // valid phone number
        'date_of_birth' => '1990-01-01',
    ]);

    $response->assertStatus(200);
    expect(User::where('email', 'john@example.com')->exists())->toBeTrue();
});

test('invalid phone number fails validation', function () {
    $response = $this->from(route('users.get'))->post(route('user.add'), [
        'full_name'     => 'Jane Doe',
        'email'         => 'jane@example.com',
        'phone_number'  => '123456789', // invalid phone number
        'date_of_birth' => '1990-01-01',
    ]);

    $response->assertRedirect(route('users.get'));
    $response->assertSessionHasErrors(['phone_number']);
});

test('duplicate email fails validation', function () {
    // Create an initial user
    User::create([
        'full_name'     => 'Alice Smith',
        'email'         => 'alice@example.com',
        'phone_number'  => '+12345678902',
        'date_of_birth' => '1991-02-02',
    ]);

    $response = $this->post(route('user.add'), [
        'full_name'     => 'Alice Johnson',
        'email'         => 'alice@example.com', // duplicate email
        'phone_number'  => '+12345678903',
        'date_of_birth' => '1992-03-03',
    ]);

    $response->assertSessionHasErrors(['email']);
});

test('invalid date format fails validation', function () {
    // The expected date format is Y-m-d (e.g., 1990-12-31)
    $response = $this->post(route('user.add'), [
        'full_name'     => 'John Doe',
        'email'         => 'john@example.com',
        'phone_number'  => '+12345678901',
        'date_of_birth' => '12-31-1990', // invalid format
    ]);

    $response->assertSessionHasErrors(['date_of_birth']);
});

test('missing required fields return validation errors', function () {
    $response = $this->post(route('user.add'), []);

    $response->assertSessionHasErrors([
        'full_name',
        'email',
        'phone_number',
        'date_of_birth',
    ]);
});

test('success toast message appears on successful user creation', function () {
    $response = $this->post(route('user.add'), [
        'full_name'     => 'John Doe',
        'email'         => 'john@example.com',
        'phone_number'  => '+12345678901',
        'date_of_birth' => '1990-12-31',
    ]);

    $response->assertSee('User added successfully!');
});

test('no users found message is shown when no users exist', function () {
    // Ensure the users table is empty
    $this->assertDatabaseCount('user', 0);

    // Visit the users page
    $response = $this->get(route('users.get'));

    // Assert "No users found" message is visible
    $response->assertSee('No users found');
});

test('users are displayed in the table after adding a user', function () {
    // Send a POST request to add a user
    $response = $this->post(route('user.add'), [
        'full_name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'phone_number' => '+1234567890',
        'date_of_birth' => '1990-01-01',
    ]);

    // Ensure the user was added to the database
    $this->assertDatabaseHas('user', [
        'full_name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'phone_number' => '+1234567890',
    ]);

    // Visit the users page
    $response = $this->get(route('users.get'));

    // Assert that the user's details appear in the table
    $response->assertSee('John Doe')
             ->assertSee('johndoe@example.com')
             ->assertSee('+1234567890');

    // Ensure "No users found" is NOT displayed
    $response->assertDontSee('No users found');
});