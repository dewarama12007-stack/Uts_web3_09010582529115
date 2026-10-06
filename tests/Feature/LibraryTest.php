<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LibraryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guest_is_redirected_to_login_from_home(): void
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_access_protected_routes(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');

        $response = $this->get('/books');
        $response->assertRedirect('/login');
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@perpustakaan.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@perpustakaan.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_authenticated_user_can_view_dashboard(): void
    {
        $user = User::first();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Total Buku');
        $response->assertSee('Total Stok');
    }

    public function test_authenticated_user_can_view_books_index(): void
    {
        $user = User::first();

        $response = $this->actingAs($user)->get('/books');
        $response->assertStatus(200);
        $response->assertSee('Daftar Buku');
        $response->assertSee('Laskar Pelangi');
    }

    public function test_authenticated_user_can_create_a_book(): void
    {
        $user = User::first();
        $category = Category::first();

        $bookData = [
            'title' => 'Buku Pemrograman Web Modern',
            'author' => 'Dewa Rama Daniel',
            'publisher' => 'Informatika Press',
            'year' => 2024,
            'stock' => 25,
            'category_id' => $category->id,
        ];

        $response = $this->actingAs($user)->post('/books', $bookData);

        $response->assertRedirect('/books');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('books', [
            'title' => 'Buku Pemrograman Web Modern',
            'author' => 'Dewa Rama Daniel',
        ]);
    }

    public function test_authenticated_user_can_view_book_detail(): void
    {
        $user = User::first();
        $book = Book::first();

        $response = $this->actingAs($user)->get('/books/' . $book->id);
        $response->assertStatus(200);
        $response->assertSee($book->title);
        $response->assertSee($book->author);
        $response->assertSee($book->category->name);
    }

    public function test_authenticated_user_can_update_a_book(): void
    {
        $user = User::first();
        $book = Book::first();

        $response = $this->actingAs($user)->put('/books/' . $book->id, [
            'title' => 'Judul Buku Telah Diperbarui',
            'author' => $book->author,
            'publisher' => $book->publisher,
            'year' => $book->year,
            'stock' => 99,
            'category_id' => $book->category_id,
        ]);

        $response->assertRedirect('/books');
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Judul Buku Telah Diperbarui',
            'stock' => 99,
        ]);
    }

    public function test_authenticated_user_can_delete_a_book(): void
    {
        $user = User::first();
        $category = Category::first();

        $book = Book::create([
            'title' => 'Buku Untuk Dihapus',
            'author' => 'Penulis Uji',
            'publisher' => 'Penerbit Uji',
            'year' => 2020,
            'stock' => 1,
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($user)->delete('/books/' . $book->id);

        $response->assertRedirect('/books');
        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }

    public function test_user_can_logout(): void
    {
        $user = User::first();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_export_books_csv(): void
    {
        $user = User::first();

        $response = $this->actingAs($user)->get('/books/export');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('katalog-buku-', $response->headers->get('Content-Disposition'));
    }

    public function test_books_search_and_filter_functionality(): void
    {
        $user = User::first();

        // Search by title
        $response = $this->actingAs($user)->get('/books?search=Pelangi');
        $response->assertStatus(200);
        $response->assertSee('Laskar Pelangi');
        $response->assertDontSee('Clean Code');

        // Filter by category
        $category = Category::where('name', 'Teknologi')->first();
        $response = $this->actingAs($user)->get('/books?category=' . $category->id);
        $response->assertStatus(200);
        $response->assertSee('Clean Code');
        $response->assertDontSee('Laskar Pelangi');
    }

    public function test_book_validation_fails_with_invalid_data(): void
    {
        $user = User::first();

        $response = $this->actingAs($user)->post('/books', [
            'title' => '',
            'author' => '',
            'publisher' => '',
            'year' => 1800,
            'stock' => -5,
            'category_id' => 999999,
        ]);

        $response->assertSessionHasErrors([
            'title',
            'author',
            'publisher',
            'year',
            'stock',
            'category_id',
        ]);
    }
}
