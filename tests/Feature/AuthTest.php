public function test_usuario_puede_registrarse() {
    $response = $this->post('/register', [
        'usuario' => 'test',
        'email' => 'test@test.com',
        'password' => '123456',
        'password_confirmation' => '123456',
        'edad' => 25,
        'peso' => 75,
        'altura' => 175,
    ]);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('usuarios', ['email' => 'test@test.com']);
}
