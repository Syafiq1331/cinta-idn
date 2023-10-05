<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Feedback;
use App\Models\Mahasiswa;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_feedback()
    {
        $mahasiswa = Mahasiswa::factory()->create();

        $response = $this->postJson('/api/feedback', [
            'ID_Mahasiswa' => $mahasiswa->id,
            'Tanggal' => '2023-10-04',
            'Isi_Feedback' => 'Ini adalah feedback dari mahasiswa',
            'Tampilkan_Nama' => true,
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Feedback berhasil disimpan']);
    }

    public function test_can_get_all_feedback()
    {
        Feedback::factory()->count(5)->create();

        $response = $this->getJson('/api/feedback');

        $response->assertStatus(200)
            ->assertJsonCount(5); // Sesuaikan dengan jumlah feedback yang Anda buat
    }
}
