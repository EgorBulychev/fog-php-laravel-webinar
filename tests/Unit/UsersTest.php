<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->seed();
    }

    public function testRegisterUser()
    {
        $user = [
            'name' => 'Test user',
            'email' => 'qwerty@qwerty.ru'
        ];
        $password = [
            'password' => 'qwerty',
            'password_confirmation' => 'qwerty'
        ];
        $response = $this->post('/register', array_merge($user, $password));

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users', $user);
    }

    public function testProfileUser() {
        $response = $this->post('/login', [
            'email' => 'user@user.com',
            'password' => 'password',
            'remember' => true
        ]);

        $response->assertRedirect('/home');

        $response->assertStatus(302);

        $profile = $this->get(route('users.profile'));

        $this->post(route('users.save.profile'), [
            'name' => 'Qwerty'
        ])->assertRedirect();

        $this->assertDatabaseHas('users', [
            'email' => 'user@user.com',
            'name' => 'Qwerty',
            'api_token' => null
        ]);

        $this->assertNull(User::where(['email' => 'user@user.com'])->first()->api_token);

        $this->get(route('users.token'));

        $this->assertNotNull(User::where(['email' => 'user@user.com'])->first()->api_token);
    }

    public function testUserCreate() {
        $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password',
            'remember' => true
        ]);
        $response->assertRedirect('/home');

        $response->assertStatus(302);

        $users = $this->get(route('users.new'));

        $users->assertStatus(200);

        $createUser = $this->post(route('users.create'), [
            'name' => 'Test user',
            'email' => 'test@test.com',
            'password' => 'password',
            'role' => 'moderator'
        ]);

        $createUser->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'Test user',
            'email' => 'test@test.com',
            'role' => 'moderator'
        ]);

        $newUser = User::where(['email' => 'test@test.com'])->first();

        $this->assertTrue(\Hash::check('password', $newUser->password));

        $this->get(route('users.edit', ['id' => $newUser->id]))->assertStatus(200);

        $this->post(route('users.save'), [
            'id' => $newUser->id,
            'role' => 'user'
        ])->assertRedirect(route('users.index'));

        $newUser = User::where(['email' => 'test@test.com'])->first();

        $this->assertEquals($newUser->role, 'user');
    }

}
