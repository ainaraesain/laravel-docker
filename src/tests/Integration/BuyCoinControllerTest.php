<?php

namespace Tests\Integration;

use App\Infrastructure\Database\WalletDataSource;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class BuyCoinControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void{
        parent::setUp();
        Wallet::factory(Wallet::class)->create();
        Transaction::factory(Transaction::class)->create();
    }

    /** @test */
    public function buyCoinWithSuccessResponse(){
        $response = $this->postJson('/api/coin/buy',['coin_id' => '90', 'wallet_id' => '1', 'amount_usd'=>10]);
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function insertedWalletIdDoesNotExist_BadRequestIsGiven(){
        $response = $this->postJson("/api/coin/buy",["coin_id" => '90', 'wallet_id' => '20', 'amount_usd' => 50000]);
        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)->assertExactJson(["error" => "wallet not found"]);
    }
}
