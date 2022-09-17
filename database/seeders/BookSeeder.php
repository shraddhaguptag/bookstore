<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use App\Models\Books; 

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $url = "https://fakerapi.it/api/v1/books?_quantity=100";
        $response = $client->request('GET', $url);

        $books = json_decode($response->getBody()->getContents(),true);

        foreach($books['data'] as $book){
           
            Books::create([
            'title' => $book['title'],
            'author' => $book['author'],
            'image_path' => $book['image'],
            'isbn' => $book['isbn'],
            'genre' => $book['genre'],
            'publication_date' => $book['published']
        ]);
        }
    }
}
