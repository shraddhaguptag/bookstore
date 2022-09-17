<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Books;
use Elasticsearch;
use Exception;

class IndexBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $books = Books::all();

        foreach ($books as $book) {
            try {
                Elasticsearch::index([
                    'id' => $book->id,
                    'index' => 'books',
                    'body' => [
                        'title' => $book->title,
                        'author' => $book->author,
                        'isbn' => $book->isbn,
                        'genre' => $book->genre,
                        'publication_date' => $book->publication_date,
                    ]
                ]);
            } catch (Exception $e) {
                $this->info($e->getMessage());
            }
        }

        $this->info("Books were successfully indexed");
    }
}
